<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Json\JsonEncoder;

class CommandExecutor
{
    private Client $client;

    private PropertyFilter $propertyFilter;

    public function __construct(
        Client $client,
        PropertyFilter $propertyFilter
    ) {
        $this->client = $client;
        $this->propertyFilter = $propertyFilter;
    }

    public function executeCommand(Command $command): void
    {
        $this->client->request(
            $command->getMethod()->value,
            $command->getPath(),
            [
                'body' => $command->getRepresentation()
                    ? (new JsonEncoder())->encode($this->propertyFilter->filter($command->getRepresentation()))
                    : null,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }
}
