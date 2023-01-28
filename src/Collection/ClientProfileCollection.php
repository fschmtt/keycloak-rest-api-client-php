<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ClientProfile;

/**
 * @extends Collection<ClientProfile>
 * @codeCoverageIgnore
 */
class ClientProfileCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ClientProfile::class;
    }
}