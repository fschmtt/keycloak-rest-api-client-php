<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

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

    public function providePolicyEnforcementModes(): array
    {
        return [
            ['DISABLED', PolicyEnforcementModeDisabled::class],
            ['ENFORCING', PolicyEnforcementModeEnforcing::class],
            ['PERMISSIVE', PolicyEnforcementModePermissive::class],
        ];
    }
}
