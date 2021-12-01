<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PolicyTest extends TestCase
{
    /**
     * @dataProvider providePolicies
     */
    public function testCreatesExpectedPolicy(string $providedPolicy, string $expectedPolicy): void
    {
        static::assertInstanceOf(
            $expectedPolicy,
            Policy::from($providedPolicy)
        );

        static::assertEquals(
            $providedPolicy,
            (string) Policy::from($providedPolicy)
        );
    }

    public function testThrowsExceptionOnInvalidPolicy(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage('Unknown Policy "foo"');

        Policy::from('foo');
    }

    public function providePolicies(): array
    {
        return [
            ['FAIL', PolicyFail::class],
            ['OVERWRITE', PolicyOverwrite::class],
            ['SKIP', PolicySkip::class],
        ];
    }
}
