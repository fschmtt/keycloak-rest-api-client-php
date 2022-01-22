<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\AuthenticatorConfig;

/**
 * @method AuthenticatorConfig[] getIterator()
 */
class AuthenticatorConfigCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return AuthenticatorConfig::class;
    }
}
