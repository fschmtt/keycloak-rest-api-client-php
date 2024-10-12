<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Json\JsonDecoder;
use Fschmtt\Keycloak\Serializer\Serializer;

/**
 * @internal
 */
class QueryExecutor
{
    public function __construct(
        private readonly Client $client,
        private readonly Serializer $serializer,
    ) {}

    public function executeQuery(Query $query): mixed
    {
        $response = $this->client->request(
            $query->getMethod()->value,
            $query->getPath(),
        );

        if ($query->getReturnType() === 'array') {
            return (new JsonDecoder())->decode($response->getBody()->getContents());
        }

        return $this->serializer->deserialize(
            $query->getReturnType(),
            $response->getBody()->getContents(),
        );
    }
}
