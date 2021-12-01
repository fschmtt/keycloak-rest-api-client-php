<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

abstract class Category extends Enum
{
    protected static function match(string $value): static
    {
        return match (strtoupper($value)) {
            'ACCESS' => new CategoryAccess(),
            'ADMIN' => new CategoryAdmin(),
            'AUTHORIZATION_RESPONSE' => new CategoryAuthorizationResponse(),
            'ID' => new CategoryId(),
            'INTERNAL' => new CategoryInternal(),
            'LOGOUT' => new CategoryLogout(),
            'USERINFO' => new CategoryUserinfo(),
        };
    }
}
