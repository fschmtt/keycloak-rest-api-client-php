<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Serializer\BooleanSerializer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(BooleanSerializer::class)]
class BooleanSerializerTest extends TestCase
{
    public function testSerializes(): void
    {
        static::assertSame(
            'bool',
            (new BooleanSerializer())->serializes(),
        );
    }

    #[DataProvider('provideData')]
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
    public static function provideData(): array
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
