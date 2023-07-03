<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\IdentityProviderMapper;

/**
 * @codeCoverageIgnore
 * @extends Collection<IdentityProviderMapper>
 */
class IdentityProviderMapperCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return IdentityProviderMapper::class;
    }
}
