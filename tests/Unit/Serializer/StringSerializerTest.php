<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Serializer\StringSerializer;
use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(StringSerializer::class)]
class StringSerializerTest extends TestCase
{
    public function testSerializes(): void
    {
        static::assertSame(
            'string',
            (new StringSerializer())->serializes(),
        );
    }

    #[DataProvider('provideData')]
    public function testSerialize(mixed $value, string $expected): void
    {
        $serializer = new StringSerializer();

        static::assertEquals(
            $expected,
            $serializer->serialize('string', $value),
        );
    }

    public static function provideData(): Generator
    {
        yield 'empty string' => ['', ''];
        yield 'string with single whitespace' => [' ', ' '];
        yield '0 as string' => ['0', '0'];
        yield '0 as integer' => [0, '0'];
        yield 'integer with string' => [' 1337  abc', ' 1337  abc'];
        yield 'true' => [true, '1'];
        yield 'false' => [false, ''];
        yield 'null' => [null, ''];
    }
}
