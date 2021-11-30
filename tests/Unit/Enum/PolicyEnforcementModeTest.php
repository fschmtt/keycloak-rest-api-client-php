<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PolicyEnforcementModeTest extends TestCase
{
    /**
     * @dataProvider providePolicyEnforcementModes
     */
    public function testCreatesExpectedPolicyEnforcementMode(
        string $providedPolicyEnforcementMode,
        string $expectedPolicyEnforcementMode
    ): void {
        static::assertInstanceOf(
            $expectedPolicyEnforcementMode,
            PolicyEnforcementMode::from($providedPolicyEnforcementMode)
        );

        static::assertEquals(
            $providedPolicyEnforcementMode,
            (string) PolicyEnforcementMode::from($providedPolicyEnforcementMode)
        );
    }

    public function testThrowsExceptionOnInvalidPolicyEnforcementMode(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage('Unknown policyEnforcementMode "foo"');

        Policy::from('foo');
    }

    public function providePolicyEnforcementModes(): array
    {
        return [
            ['DISABLED', PolicyEnforcementModeDisabled::class],
            ['ENFORCING', PolicyEnforcementModeEnforcing::class],
            ['PERMISSIVE', PolicyEnforcementModePermissive::class],
        ];
    }
}
