<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Client;

/**
 * @codeCoverageIgnore
 */
class ClientCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Client::class;
    }
}
