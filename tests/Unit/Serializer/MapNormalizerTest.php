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
        $normalizer = new MapNormalizer();

        static::assertSame(
            [Map::class => true],
            $normalizer->getSupportedTypes('json'),
        );
    }

    public function testSupportsNormalization(): void
    {
        $normalizer = new MapNormalizer();

        static::assertTrue($normalizer->supportsNormalization(new Map()));
        static::assertFalse($normalizer->supportsNormalization([]));
    }

    #[DataProvider('maps')]
    public function testNormalize(mixed $value, ArrayObject $expected): void
    {
        $normalizer = new MapNormalizer();

        self::assertEquals(
            $expected,
            $normalizer->normalize($value, Map::class),
        );
    }

    public static function maps(): Generator
    {
        yield 'filled array' => [
            new Map([
                'a' => 1,
                'b' => 2,
                'c' => 3,
            ]),
            new ArrayObject([
                'a' => 1,
                'b' => 2,
                'c' => 3,
            ]),
        ];

        yield 'empty array' => [
            new Map([]),
            new ArrayObject(),
        ];
    }
}
