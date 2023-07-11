<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Role;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<Role>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class RoleCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Role::class;
    }
}
