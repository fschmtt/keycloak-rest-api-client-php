<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Client;

/**
 * @method Client[] getIterator()
 */
class ClientCollection extends Collection
{
    public function getRepresentationClass(): string
    {
        return Client::class;
    }
}
