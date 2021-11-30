<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class UseEnumSig extends UseEnum
{
    public function __toString(): string
    {
        return 'SIG';
    }
}
