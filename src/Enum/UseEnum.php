<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use InvalidArgumentException;

abstract class UseEnum extends Enum
{
    public static function from(string $value): static
    {
        return match (strtoupper($value)) {
            'ENC' => new UseEnumEnc(),
            'SIG' => new UseEnumSig(),
            default => throw new InvalidArgumentException(sprintf('Unknown use "%s"', $value)),
        };
    }
}
