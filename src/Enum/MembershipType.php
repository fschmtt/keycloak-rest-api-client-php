<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

enum MembershipType: string implements Enum
{
    case MANAGED = 'MANAGED';
    case UNMANAGED = 'UNMANAGED';
}
