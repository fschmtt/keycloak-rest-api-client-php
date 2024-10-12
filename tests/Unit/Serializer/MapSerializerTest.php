<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Serializer\MapSerializer;
use Fschmtt\Keycloak\Type\Map;
use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(MapSerializer::class)]
class MapSerializerTest extends TestCase
{
    public function testSerializes(): void
    {
        static::assertSame(
            Map::class,
            (new MapSerializer())->serializes(),
        );
    }

    #[DataProvider('maps')]
    public function testSerialize(mixed $value, Map $expected): void
    {
        $serializer = new MapSerializer();

        self::assertEquals(
            $expected,
            $serializer->serialize(Map::class, $value),
        );
    }

    public static function maps(): Generator
    {
        yield 'filled array' => [
            [
                'a' => 1,
                'b' => 2,
                'c' => 3,
            ],
            new Map([
                'a' => 1,
                'b' => 2,
                'c' => 3,
            ]),
        ];

        yield 'empty array' => [
            [],
            new Map(),
        ];

        yield 'non-array' => [
            1337,
            new Map(),
        ];

        yield Map::class => [
            new Map([
                'a' => 1,
            ]),
            new Map([
                'a' => 1,
            ]),
        ];
    }
}
