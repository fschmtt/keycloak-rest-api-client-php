<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class CategoryUserinfo extends Category
{
    public function __toString(): string
    {
        return 'USERINFO';
    }
}
