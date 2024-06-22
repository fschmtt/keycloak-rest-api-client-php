<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Json\JsonEncoder;
use Fschmtt\Keycloak\Representation\Representation;

/**
 * @internal
 */
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
        $payload = $command->getPayload();

        if ($payload === null) {
            return null;
        }

        $jsonEncoder = new JsonEncoder();

        if (is_array($payload)) {
            return $jsonEncoder->encode($payload);
        }

        if ($payload instanceof Representation) {
            return $jsonEncoder->encode($this->propertyFilter->filter($payload));
        }

        $representations = [];

        foreach ($payload as $representation) {
            $representations[] = $this->propertyFilter->filter($representation);
        }

        return $jsonEncoder->encode($representations);
    }
}
