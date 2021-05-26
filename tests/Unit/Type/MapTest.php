<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Type;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Type\Map
 */
class MapTest extends TestCase
{
    public function testCanBeConstructedFromEmptyArray(): void
    {
        $map = new Map();

        self::assertEquals(
            (object) [],
            $map->jsonSerialize()
        );
    }

    public function testBeConstructedFromFilledArray(): void
    {
        $array = [
            'key-1' => 'value-1',
            'key-2' => 'value-2',
            'key-3' => 'value-3',
        ];

        $map = new Map($array);

        self::assertEquals(
            (object) $array,
            $map->jsonSerialize()
        );
    }
}
