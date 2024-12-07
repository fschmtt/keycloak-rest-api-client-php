<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Serializer\Serializer;

use function is_array;

/**
 * @internal
 */
class CommandExecutor
{
    public function __construct(
        private readonly Client $client,
        private readonly Serializer $serializer,
    ) {}

    public function executeCommand(Command $command): void
    {
        $payload = $command->getPayload();

        if (is_array($payload)) {
            $this->client->request(
                $command->getMethod()->value,
                $command->getPath(),
                [
                    'form_params' => $payload,
                ],
            );

            return;
        }

        $this->client->request(
            $command->getMethod()->value,
            $command->getPath(),
            [
                'body' => $this->serializer->serialize($command->getPayload()),
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ],
        );
    }
}
