<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Serializer\BooleanSerializer;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers \Fschmtt\Keycloak\Serializer\BooleanSerializer
 */
class BooleanSerializerTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testSerialize(mixed $value, bool $expected): void
    {
        $serializer = new BooleanSerializer();

        if ($expected === true) {
            static::assertTrue($serializer->serialize('bool', $value));
        } else {
            static::assertFalse($serializer->serialize('bool', $value));
        }
    }

    /**
     * @return array<mixed>
     */
    public function provideData(): array
    {
        return [
            ['', false],
            [' ', false],
            ['0', false],
            ['1', true],
            ['true', true],
            ['false', false],
            [true, true],
            [false, false],
            [new stdClass(), true],
            [null, false],
        ];
    }
}
