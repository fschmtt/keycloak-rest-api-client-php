<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Http\Client\Client;
use Fschmtt\Keycloak\Json\JsonEncoder;
use Fschmtt\Keycloak\Representation\Representation;

class CommandExecutor
{
    public function __construct(
        private readonly Client         $client,
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

        $jsonEncoder = new JsonEncoder();

        if ($command->getPayload() instanceof Representation) {
            return $jsonEncoder->encode($this->propertyFilter->filter($command->getPayload()));
        }

        $representations = [];

        foreach ($command->getPayload() as $representation) {
            $representations[] = $this->propertyFilter->filter($representation);
        }

        return $jsonEncoder->encode($representations);
    }
}
