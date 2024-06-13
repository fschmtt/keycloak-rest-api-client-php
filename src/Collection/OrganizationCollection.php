<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Organization;

/**
 * @extends Collection<Organization>
 *
 * @codeCoverageIgnore
 */
class OrganizationCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Organization::class;
    }
}
