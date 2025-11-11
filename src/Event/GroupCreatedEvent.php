<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Event;

use Psr\Http\Message\ResponseInterface;

class GroupCreatedEvent extends KeycloakEvent
{
    public function __construct(
        public readonly string $groupId,
    ) {}

    public static function fromResponse(ResponseInterface $response): self
    {
        $parts = explode('/', trim($response->getHeaderLine('Location'), '/'));
        $groupId = end($parts);

        return new self($groupId);
    }
}
