<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\Representation;

class CommandWithRepresentationStub extends Command
{
    public function getMethod(): Method
    {
        return Method::PUT;
    }

    public function getPath(): string
    {
        return '/path/to/resource';
    }

    public function getRepresentation(): ?Representation
    {
        return new Realm();
    }
}
