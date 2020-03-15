<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class PolicyEnforcementModePermissive implements PolicyEnforcementMode
{
    public function __toString(): string
    {
        return 'PERMISSIVE';
    }
}
