<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class RequiredActionCollection extends EnumCollection
{
    public static function getEnumClass(): string
    {
        return RequiredAction::class;
    }
}
