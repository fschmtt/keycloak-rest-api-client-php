<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class PolicyEnforcementModeDisabled extends PolicyEnforcementMode
{
    public function __toString(): string
    {
        return 'DISABLED';
    }
}
