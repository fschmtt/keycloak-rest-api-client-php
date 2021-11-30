<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class UseEnumEnc extends UseEnum
{
    public function __toString(): string
    {
        return 'ENC';
    }
}
