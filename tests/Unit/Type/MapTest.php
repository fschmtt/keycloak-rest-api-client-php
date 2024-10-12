<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Type;

use Fschmtt\Keycloak\Type\Map;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Map::class)]
class MapTest extends TestCase
{
    public function testCanBeConstructedFromEmptyArray(): void
    {
        $map = new Map();

        self::assertEquals(
            (object) [],
            $map->jsonSerialize(),
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
            $map->jsonSerialize(),
        );
    }

    public function testCanBeIterated(): void
    {
        $map = new Map([
            'key-1' => 'value-1',
            'key-2' => 'value-2',
            'key-3' => 'value-3',
        ]);

        foreach ($map as $key => $value) {
            static::assertStringStartsWith('key-', $key);
            static::assertStringStartsWith('value-', $value);
        }
    }

    public function testCanBeCounted(): void
    {
        $map = new Map([
            'key-1' => 'value-1',
            'key-2' => 'value-2',
            'key-3' => 'value-3',
        ]);

        static::assertCount(3, $map);
    }
}
