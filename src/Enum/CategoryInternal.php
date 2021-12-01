<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class CategoryInternal extends Category
{
    public function __toString(): string
    {
        return 'INTERNAL';
    }
}
