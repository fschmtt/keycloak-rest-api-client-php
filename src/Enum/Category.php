<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use InvalidArgumentException;

abstract class Category extends Enum
{
    public static function from(string $value): static
    {
        return match (strtoupper($value)) {
            'ACCESS' => new CategoryAccess(),
            'ADMIN' => new CategoryAdmin(),
            'AUTHORIZATION_RESPONSE' => new CategoryAuthorizationResponse(),
            'ID' => new CategoryId(),
            'INTERNAL' => new CategoryInternal(),
            'LOGOUT' => new CategoryLogout(),
            'USERINFO' => new CategoryUserinfo(),
            default => throw new InvalidArgumentException(sprintf('Unknown category "%s"', $value)),
        };
    }
}
