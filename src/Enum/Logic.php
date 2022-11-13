<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

enum Logic: string implements Enum
{
    case NEGATIVE = 'NEGATIVE';
    case POSITIVE = 'POSITIVE';
}
