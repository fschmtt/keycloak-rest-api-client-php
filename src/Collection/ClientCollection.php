<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Client;

/**
 * @method Client[] getIterator()
 * @method Client|null first()
 *
 * @codeCoverageIgnore
 */
class ClientCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Client::class;
    }
}
