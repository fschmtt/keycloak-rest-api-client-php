<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class PolicyOverwrite extends Policy
{
    public function __toString(): string
    {
        return 'OVERWRITE';
    }
}
