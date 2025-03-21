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
        $options = match ($command->getContentType()) {
            ContentType::JSON => [
                'body' => $this->serializer->serialize($command->getPayload()),
                'headers' => [
                    'Content-Type' => $command->getContentType()->value,
                ],
            ],
            ContentType::FORM_PARAMS => ['form_params' => $command->getPayload()],
        };

        $this->client->request(
            $command->getMethod()->value,
            $command->getPath(),
            $options,
        );
    }
}
