<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use InvalidArgumentException;

abstract class UseEnum extends Enum
{
    public static function from(string $value): static
    {
        return match (strtoupper($value)) {
            'NEGATIVE' => new LogicNegative(),
            'POSITIVE' => new LogicPositive(),
            default => throw new InvalidArgumentException(sprintf('Unknown logic "%s"', $value)),
        };
    }
}
