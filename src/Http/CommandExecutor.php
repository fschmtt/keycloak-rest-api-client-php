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
                'body' => $this->prepareBody($command),
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }

    protected function prepareBody(Command $command): ?string
    {
        if ($command->getPayload() === null) {
            return null;
        }

        if (is_array($command->getPayload())) {
            $payload = array_map([$this->propertyFilter, 'filter'], $command->getPayload());
        } else {
            $payload = $this->propertyFilter->filter($command->getPayload());
        }

        return (new JsonEncoder())->encode($payload);
    }
}
