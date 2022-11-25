<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

enum PolicyEnforcementMode: string implements Enum
{
    case DISABLED = 'DISABLED';
    case ENFORCING = 'ENFORCING';
    case PERMISSIVE = 'PERMISSIVE';
}
