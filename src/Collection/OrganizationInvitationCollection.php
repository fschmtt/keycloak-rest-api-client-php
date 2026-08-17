<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\OrganizationInvitation;

/**
 * @extends Collection<OrganizationInvitation>
 *
 * @codeCoverageIgnore
 */
class OrganizationInvitationCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return OrganizationInvitation::class;
    }
}
