<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Serializer\MapSerializer;
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
            $expected,
            $serializer->serialize(Map::class, $value),
        );
    }

    public function provideData(): array
    {
        return [
            [
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
            ],
            [
                [],
                new Map(),
            ],
            [
                1337,
                new Map(),
            ],
        ];
    }
}
