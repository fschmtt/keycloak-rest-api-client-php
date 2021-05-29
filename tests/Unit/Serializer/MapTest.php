<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Serializer\Map
 */
class MapTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testSerialize(mixed $value, \Fschmtt\Keycloak\Type\Map $expected): void
    {
        $serializer = new Map();

        self::assertEquals(
            $serializer->serialize($value),
            $expected
        );
    }

    public function provideData(): array
    {
        return [
            [
                ['a' => 1, 'b' => 2, 'c' => 3],
                new \Fschmtt\Keycloak\Type\Map([ 'a' => 1, 'b' => 2, 'c' => 3])
            ],
            [
                [],
                new \Fschmtt\Keycloak\Type\Map()
            ],
            [
                1337,
                new \Fschmtt\Keycloak\Type\Map()
            ],
        ];
    }
}
