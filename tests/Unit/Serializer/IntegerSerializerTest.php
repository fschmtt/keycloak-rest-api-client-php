<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Serializer\IntegerSerializer
 */
class IntegerSerializerTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testSerialize(mixed $value, int $expected): void
    {
        $serializer = new IntegerSerializer();

        static::assertEquals(
            $serializer->serialize('int', $value),
            $expected
        );
    }

    public function provideData(): array
    {
        return [
            ['', 0],
            [' ', 0],
            ['0', 0],
            ['1', 1],
            ['1337', 1337],
            [' 1337  abc', 1337],
            [true, 1],
            [false, 0],
            [null, 0]
        ];
    }
}
