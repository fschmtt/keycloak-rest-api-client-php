<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class PolicyFail extends PolicyEnforcementMode
{
    public function __toString(): string
    {
        return 'FAIL';
    }
}
