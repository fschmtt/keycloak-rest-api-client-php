<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Exception;

use Exception;

class ResourceAlreadyRegisteredException extends Exception
{
    public function __construct(string $resource)
    {
        parent::__construct(sprintf('Resource "%s" is already registered.', $resource));
    }
}
