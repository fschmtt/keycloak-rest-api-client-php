<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ClientPolicy;

/**
 * @codeCoverageIgnore
 */
class ClientPolicyCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ClientPolicy::class;
    }
}
