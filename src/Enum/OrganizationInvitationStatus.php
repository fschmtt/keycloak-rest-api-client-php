<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

enum OrganizationInvitationStatus: string implements Enum
{
    case PENDING = 'PENDING';
    case EXPIRED = 'EXPIRED';
}
