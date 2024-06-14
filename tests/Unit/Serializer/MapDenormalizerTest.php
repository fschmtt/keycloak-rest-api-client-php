<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Serializer\MapDenormalizer;
use Fschmtt\Keycloak\Type\Map;
use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(MapDenormalizer::class)]
class MapDenormalizerTest extends TestCase
{
    public function testSupportedTypes(): void
    {
        $denormalizer = new MapDenormalizer();

        static::assertSame(
            [Map::class => true],
            $denormalizer->getSupportedTypes('json'),
        );
    }

    public function testSupportsDenormalization(): void
    {
        $denormalizer = new MapDenormalizer();

        static::assertTrue($denormalizer->supportsDenormalization([], Map::class));
        static::assertFalse($denormalizer->supportsDenormalization([], 'array'));
    }
    #[DataProvider('maps')]
    public function testDenormalize(mixed $value, Map $expected): void
    {
        $denormalizer = new MapDenormalizer();

        self::assertEquals(
            $expected,
            $denormalizer->denormalize($value, Map::class),
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
