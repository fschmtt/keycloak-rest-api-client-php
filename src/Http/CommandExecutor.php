<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Json\JsonEncoder;
use Fschmtt\Keycloak\Representation\Representation;
use Fschmtt\Keycloak\Serializer\Serializer;

class CommandExecutor
{
    public function __construct(
        private readonly Client $client,
        private readonly Serializer $serializer
    ) {
    }

    public function executeCommand(Command $command): void
    {
        $this->client->request(
            $command->getMethod()->value,
            $command->getPath(),
            [
                'body' => $this->serializer->serialize($command->getPayload()),
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }
}
