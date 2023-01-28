<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\UserFederationMapper;

/**
 * @codeCoverageIgnore
 */
class UserFederationMapperCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return UserFederationMapper::class;
    }
}
