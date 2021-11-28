<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Collection\ClientCollection;
use Fschmtt\Keycloak\Representation\Client;

class ClientCollectionSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return ClientCollection::class;
    }

    public function serialize($value): ClientCollection
    {
        $clients = [];

        foreach ($value as $client) {
            $clients[] = Client::from($client);
        }

        return new ClientCollection($clients);
    }
}
