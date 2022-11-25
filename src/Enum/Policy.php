<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

enum Policy: string implements Enum
{
    case FAIL = 'FAIL';
    case OVERWRITE = 'OVERWRITE';
    case SKIP = 'SKIP';
}
