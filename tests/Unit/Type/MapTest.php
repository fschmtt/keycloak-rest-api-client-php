<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Type;

use Fschmtt\Keycloak\Type\Map;
use OutOfBoundsException;
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

    public function testContains(): void
    {
        $map = new Map(['key-1' => 'value-1', 'key-2' => 'value-2']);

        static::assertTrue($map->contains('key-1'));
        static::assertTrue($map->contains('key-2'));
        static::assertFalse($map->contains('key-3'));
    }

    public function testGet(): void
    {
        $map = new Map(['key-1' => 'value-1', 'key-2' => 'value-2']);

        static::assertSame('value-1', $map->get('key-1'));
        static::assertSame('value-2', $map->get('key-2'));
    }

    public function testGetThrows(): void
    {
        $map = new Map(['key-1' => 'value-1', 'key-2' => 'value-2']);

        static::expectException(OutOfBoundsException::class);
        static::expectExceptionMessage('Key "key-3" does not exist in map');

        $map->get('key-3');
    }

    public function testWith(): void
    {
        $map = new Map(['key-1' => 'value-1', 'key-2' => 'value-2']);

        $updatedMap = $map->with('key-3', 'value-3');

        static::assertNotSame($map, $updatedMap);
        static::assertCount(2, $map);
        static::assertCount(3, $updatedMap);
    }

    public function testWithout(): void
    {
        $map = new Map(['key-1' => 'value-1', 'key-2' => 'value-2']);

        $updatedMap = $map->without('key-2');

        static::assertNotSame($map, $updatedMap);
        static::assertCount(2, $map);
        static::assertCount(1, $updatedMap);
    }

    public function testGetMap(): void
    {
        $inner = ['key-1' => 'value-1', 'key-2' => 'value-2'];
        $map = new Map($inner);

        static::assertSame($inner, $map->getMap());
    }
}
