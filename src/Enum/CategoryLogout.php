<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class CategoryLogout extends Category
{
    public function __toString(): string
    {
        return 'LOGOUT';
    }
}
