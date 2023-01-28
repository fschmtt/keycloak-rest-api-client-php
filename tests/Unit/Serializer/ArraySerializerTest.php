<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Serializer\ArraySerializer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Serializer\ArraySerializer
 */
class ArraySerializerTest extends TestCase
{
    /**
     * @param array<mixed> $expected
     * @dataProvider provideData
     */
    public function testSerialize(mixed $value, array $expected): void
    {
        $serializer = new ArraySerializer();

        static::assertSame(
            $expected,
            $serializer->serialize('array', $value),
        );
    }

    /**
     * @return array<mixed>
     */
    public function provideData(): array
    {
        return [
            [[
                'foo' => 'bar',
            ], [
                'foo' => 'bar',
            ]],
            [
                'foo', [
                    0 => 'foo',
                ], ],
            [
                1337, [
                    0 => 1337,
                ], ],
        ];
    }
}
