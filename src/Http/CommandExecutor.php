<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;

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
        $this->executeCommandWithResponse($command);
    }

    public function executeCommandWithResponse(Command $command): ResponseInterface
    {
        $payload = $command->getPayload();

        $options = match ($command->getContentType()) {
            ContentType::JSON => [
                'body' => is_string($payload) ? $payload : $this->serializer->serialize($payload),
                'headers' => [
                    'Content-Type' => $command->getContentType()->value,
                ],
            ],
            ContentType::FORM_PARAMS => ['form_params' => $payload],
        };

        return $this->client->request(
            $command->getMethod()->value,
            $command->getPath(),
            $options,
        );
    }
}
