<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class PolicyEnforcementModeEnforcing extends PolicyEnforcementMode
{
    public function __toString(): string
    {
        return 'ENFORCING';
    }
}
