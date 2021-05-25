<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Http\Client;

abstract class Resource
{
    public function __construct(protected Client $httpClient)
    {
    }
}
