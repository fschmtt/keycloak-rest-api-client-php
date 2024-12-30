<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use ArrayObject;
use Fschmtt\Keycloak\Serializer\MapNormalizer;
use Fschmtt\Keycloak\Type\Map;
use Generator;
use InvalidArgumentException;
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

        static::assertEquals(
            $expected,
            $normalizer->normalize($value, Map::class),
        );
    }

    public function testThrowsIfDataIsNotAMap(): void
    {
        $normalizer = new MapNormalizer();

        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage(sprintf('Data must be an instance of "%s"', Map::class));

        $normalizer->normalize([]);
    }

    public static function maps(): Generator
    {
        yield 'filled map' => [
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

        yield 'empty map' => [
            new Map(),
            new ArrayObject(),
        ];
    }
}
