<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\PropertyFilter\PropertyFilter;

abstract class Resource
{
    public function __construct(protected Client $httpClient, protected PropertyFilter $propertyFilter)
    {
    }
}
