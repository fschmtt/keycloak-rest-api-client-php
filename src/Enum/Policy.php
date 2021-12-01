<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

abstract class Policy extends Enum
{
    protected static function match(string $value): static
    {
        return match (strtoupper($value)) {
            'FAIL' => new PolicyFail(),
            'OVERWRITE' => new PolicyOverwrite(),
            'SKIP' => new PolicySkip(),
        };
    }
}
