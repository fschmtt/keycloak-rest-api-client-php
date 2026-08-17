<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\OrganizationMember;

/**
 * @extends Collection<OrganizationMember>
 *
 * @codeCoverageIgnore
 */
class OrganizationMemberCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return OrganizationMember::class;
    }
}
