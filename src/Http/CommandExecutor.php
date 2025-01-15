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
        $contentType = $command->getContentType();
        $payload = $command->getPayload();

        $options = [
            'headers' => [
                'Content-Type' => $contentType->value,
            ],
        ];

        switch ($contentType) {
            case ContentType::JSON:
                $options['body'] = $this->serializer->serialize($payload);
                break;
            case ContentType::FORM_DATA:
                $options['form_params'] = $payload;
                break;
        }

        $this->client->request(
            $command->getMethod()->value,
            $command->getPath(),
            $options,
        );
    }
}
