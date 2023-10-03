<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Role;

/**
 * @extends Collection<Role>
 *
 * @codeCoverageIgnore
 */
class RoleCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Role::class;
    }
}
