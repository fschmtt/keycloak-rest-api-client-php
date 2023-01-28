<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\FederatedIdentity;

/**
 * @codeCoverageIgnore
 */
class FederatedIdentityCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return FederatedIdentity::class;
    }
}
