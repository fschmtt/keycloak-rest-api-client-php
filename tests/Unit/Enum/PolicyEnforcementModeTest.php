<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

class PolicyEnforcementModeTest extends TestCase
{
    /**
     * @dataProvider providePolicyEnforcementModes
     */
    public function testCreatesExpectedNodeType(string $providedNodeType, string $expectedNodeType): void
    {
        static::assertInstanceOf(
            $expectedNodeType,
            PolicyEnforcementMode::from($providedNodeType)
        );

        static::assertEquals(
            $providedNodeType,
            (string) PolicyEnforcementMode::from($providedNodeType)
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
