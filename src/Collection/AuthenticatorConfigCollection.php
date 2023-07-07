<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\AuthenticatorConfig;

/**
 * @codeCoverageIgnore
 * @extends Collection<AuthenticatorConfig>
 */
class AuthenticatorConfigCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return AuthenticatorConfig::class;
    }
}
