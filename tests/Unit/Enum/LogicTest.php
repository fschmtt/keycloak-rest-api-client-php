<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

class LogicTest extends TestCase
{
    /**
     * @dataProvider provideLogics
     */
    public function testCreatesExpectedLogic(string $providedLogic, string $expectedLogic): void
    {
        static::assertInstanceOf(
            $expectedLogic,
            Logic::from($providedLogic)
        );

        static::assertEquals(
            $providedLogic,
            (string) Logic::from($providedLogic)
        );
    }

    public function provideLogics(): array
    {
        return [
            ['NEGATIVE', LogicNegative::class],
            ['POSITIVE', LogicPositive::class],
        ];
    }
}
