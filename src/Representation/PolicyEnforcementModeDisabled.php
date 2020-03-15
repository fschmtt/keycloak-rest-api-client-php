<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class PolicyEnforcementModeDisabled implements PolicyEnforcementMode
{
    public function __toString(): string
    {
        return 'DISABLED';
    }
}
