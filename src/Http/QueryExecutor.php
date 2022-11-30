<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Json\JsonDecoder;
use Fschmtt\Keycloak\Serializer\Serializer;

class QueryExecutor
{
    private Client $client;
    private Serializer $serializer;

    public function __construct(Client $client, Serializer $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    public function executeQuery(Query $query): mixed
    {
        $response = $this->client->request(
            $query->getMethod()->value,
            $query->getPath(),
        );

        return $this->serializer->serialize(
            $query->getReturnType(),
            (new JsonDecoder())->decode($response->getBody()->getContents())
        );
    }
}
