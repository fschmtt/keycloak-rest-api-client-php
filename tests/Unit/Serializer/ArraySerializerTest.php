<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Serializer\ArraySerializer
 */
class ArraySerializerTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testSerialize(mixed $value, array $expected): void
    {
        $serializer = new ArraySerializer();

        static::assertEquals(
            $serializer->serialize($value),
            $expected
        );
    }

    public function provideData(): array
    {
        return [
            [['foo' => 'bar'], ['foo' => 'bar']],
            ['foo', [0 => 'foo']],
            [1337, [0 => 1337]],
        ];
    }
}
