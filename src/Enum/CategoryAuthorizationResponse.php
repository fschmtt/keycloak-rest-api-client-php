<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class CategoryAuthorizationResponse extends Category
{
    public function __toString(): string
    {
        return 'AUTHORIZATION_RESPONSE';
    }
}
