<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class CategoryAdmin extends Category
{
    public function __toString(): string
    {
        return 'ADMIN';
    }
}
