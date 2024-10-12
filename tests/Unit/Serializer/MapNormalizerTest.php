<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use ArrayObject;
use Fschmtt\Keycloak\Serializer\MapNormalizer;
use Fschmtt\Keycloak\Type\Map;
use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(MapNormalizer::class)]
class MapNormalizerTest extends TestCase
{
    public function testSupportedTypes(): void
    {
        $denormalizer = new MapNormalizer();

        static::assertSame(
            [Map::class => true],
            $denormalizer->getSupportedTypes('json'),
        );
    }

    public function testSupportsNormalization(): void
    {
        $denormalizer = new MapNormalizer();

        static::assertTrue($denormalizer->supportsNormalization(new Map()));
        static::assertFalse($denormalizer->supportsNormalization([]));
    }
    #[DataProvider('maps')]
    public function testNormalize(mixed $value, ArrayObject $expected): void
    {
        $denormalizer = new MapNormalizer();

        self::assertEquals(
            $expected,
            $denormalizer->normalize($value, Map::class),
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
            new ArrayObject([
                'a' => 1,
                'b' => 2,
                'c' => 3,
            ]),
        ];

        yield 'empty array' => [
            [],
            new ArrayObject(),
        ];

        yield Map::class => [
            new ArrayObject([
                'a' => 1,
            ]),
            new ArrayObject([
                'a' => 1,
            ]),
        ];
    }
}
