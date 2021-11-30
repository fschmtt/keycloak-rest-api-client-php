<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class CategoryId extends Category
{
    public function __toString(): string
    {
        return 'ID';
    }
}
