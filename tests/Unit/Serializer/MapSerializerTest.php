<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Type\Map;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Serializer\MapSerializer
 * @uses \Fschmtt\Keycloak\Type\Map
 */
class MapSerializerTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testSerialize(mixed $value, Map $expected): void
    {
        $serializer = new MapSerializer();

        self::assertEquals(
            $serializer->serialize(Map::class, $value),
            $expected
        );
    }

    public function provideData(): array
    {
        return [
            [
                ['a' => 1, 'b' => 2, 'c' => 3],
                new Map([ 'a' => 1, 'b' => 2, 'c' => 3])
            ],
            [
                [],
                new Map()
            ],
            [
                1337,
                new Map()
            ],
        ];
    }
}
