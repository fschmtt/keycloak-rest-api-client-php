<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

enum Category: string implements Enum
{
    case ACCESS = 'ACCESS';
    case ADMIN = 'ADMIN';
    case AUTHORIZATION_RESPONSE = 'AUTHORIZATION_RESPONSE';
    case ID = 'ID';
    case INTERNAL = 'INTERNAL';
    case LOGOUT = 'LOGOUT';
    case USERINFO = 'USERINFO';
}
