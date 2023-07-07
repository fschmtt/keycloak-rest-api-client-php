<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Serializer\ArraySerializer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ArraySerializer::class)]
class ArraySerializerTest extends TestCase
{
    public function testSerializes(): void
    {
        static::assertSame(
            'array',
            (new ArraySerializer())->serializes()
        );
    }

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
    public static function provideData(): array
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
