<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

abstract class PolicyEnforcementMode extends Enum
{
    public static function from(string $value): static
    {
        return match (strtoupper($value)) {
            'DISABLED' => new PolicyEnforcementModeDisabled(),
            'ENFORCING' => new PolicyEnforcementModeEnforcing(),
            'PERMISSIVE' => new PolicyEnforcementModePermissive(),
            default => throw new \InvalidArgumentException(sprintf('Unknown policy enforcement mode "%s"', $value)),
        };
    }
}
