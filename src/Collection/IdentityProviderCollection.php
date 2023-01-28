<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\IdentityProvider;

/**
 * @codeCoverageIgnore
 */
class IdentityProviderCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return IdentityProvider::class;
    }
}
