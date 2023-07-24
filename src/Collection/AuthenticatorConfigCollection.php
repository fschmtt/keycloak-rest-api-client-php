<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\AuthenticatorConfig;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<AuthenticatorConfig>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class AuthenticatorConfigCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return AuthenticatorConfig::class;
    }
}
