<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Representation\ServerInfo as ServerInfoRepresentation;

class ServerInfo extends Resource
{
    private const BASE_PATH = '/admin/serverinfo';

    public function get(): ServerInfoRepresentation
    {
        return ServerInfoRepresentation::fromJson(
            (string) $this->httpClient->request(
                'GET',
                self::BASE_PATH
            )->getBody()
        );
    }
}
