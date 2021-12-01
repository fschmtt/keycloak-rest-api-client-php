<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use InvalidArgumentException;
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

    public function testThrowsExceptionOnInvalidLogic(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage('Unknown Logic "foo"');

        Logic::from('foo');
    }

    public function provideLogics(): array
    {
        return [
            ['NEGATIVE', LogicNegative::class],
            ['POSITIVE', LogicPositive::class],
        ];
    }
}
