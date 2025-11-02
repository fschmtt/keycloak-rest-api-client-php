<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Event;

use Psr\Http\Message\ResponseInterface;
use Symfony\Contracts\EventDispatcher\Event;

abstract class KeycloakEvent extends Event
{
    abstract public static function fromResponse(ResponseInterface $response): self;
}
