<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Serializer\Serializer;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @internal
 */
class CommandExecutor
{
    public function __construct(
        private readonly Client $client,
        private readonly Serializer $serializer,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {}

    public function executeCommand(Command $command): void
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

        $response = $this->client->request(
            $command->getMethod()->value,
            $command->getPath(),
            $options,
        );

        if ($event = $command->getEvent()) {
            $this->eventDispatcher->dispatch($event::fromResponse($response));
        }
    }
}
