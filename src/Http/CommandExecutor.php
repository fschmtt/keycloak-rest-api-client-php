<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Json\JsonEncoder;

class CommandExecutor
{
    public function __construct(
        private readonly Client $client,
        private readonly PropertyFilter $propertyFilter
    ) {
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
