<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UseEnumTest extends TestCase
{
    /**
     * @dataProvider provideUses
     */
    public function testCreatesExpectedUse(string $providedUse, string $expectedUse): void
    {
        static::assertInstanceOf(
            $expectedUse,
            UseEnum::from($providedUse)
        );

        static::assertEquals(
            $providedUse,
            (string) UseEnum::from($providedUse)
        );
    }

    public function testThrowsExceptionOnInvalidUse(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage('Unknown UseEnum "foo"');

        UseEnum::from('foo');
    }

    public function provideUses(): array
    {
        return [
            ['ENC', UseEnumEnc::class],
            ['SIG', UseEnumSig::class],
        ];
    }
}
