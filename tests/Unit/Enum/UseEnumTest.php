<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

class UseEnumTest extends TestCase
{
    /**
     * @dataProvider provideUses
     */
    public function testCreatesExpectedNodeType(string $providedUse, string $expectedUse): void
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

    public function provideUses(): array
    {
        return [
            ['ENC', UseEnumEnc::class],
            ['SIG', UseEnumSig::class],
        ];
    }
}
