<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class PolicyEnforcementModePermissive extends PolicyEnforcementMode
{
    public function __toString(): string
    {
        return 'PERMISSIVE';
    }
}
