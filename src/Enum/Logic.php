<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

abstract class Logic extends Enum
{
    protected static function match(string $value): static
    {
        return match (strtoupper($value)) {
            'NEGATIVE' => new LogicNegative(),
            'POSITIVE' => new LogicPositive(),
        };
    }
}
