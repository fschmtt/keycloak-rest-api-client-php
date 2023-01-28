<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\AuthenticatorConfig;

/**
 * @extends Collection<AuthenticatorConfig>
 *
 * @codeCoverageIgnore
 */
class AuthenticatorConfigCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return AuthenticatorConfig::class;
    }
}
