<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

abstract class PolicyEnforcementMode extends Enum
{
    protected static function match(string $value): static
    {
        return match (strtoupper($value)) {
            'DISABLED' => new PolicyEnforcementModeDisabled(),
            'ENFORCING' => new PolicyEnforcementModeEnforcing(),
            'PERMISSIVE' => new PolicyEnforcementModePermissive(),
        };
    }
}
