<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\UserFederationProvider;

/**
 * @extends Collection<UserFederationProvider>
 * @codeCoverageIgnore
 */
class UserFederationProviderCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return UserFederationProvider::class;
    }
}
