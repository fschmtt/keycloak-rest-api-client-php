<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\OrganizationDomain;

/**
 * @extends Collection<OrganizationDomain>
 *
 * @codeCoverageIgnore
 */
class OrganizationDomainCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return OrganizationDomain::class;
    }
}
