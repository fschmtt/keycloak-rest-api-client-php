<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use InvalidArgumentException;

abstract class UseEnum extends Enum
{
    protected static function match(string $value): static
    {
        return match (strtoupper($value)) {
            'ENC' => new UseEnumEnc(),
            'SIG' => new UseEnumSig(),
        };
    }
}
