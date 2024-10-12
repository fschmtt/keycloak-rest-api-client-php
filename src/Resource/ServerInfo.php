<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\ServerInfo as ServerInfoRepresentation;

class ServerInfo extends Resource
{
    public function get(): ServerInfoRepresentation
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/serverinfo',
                ServerInfoRepresentation::class,
            ),
        );
    }
}
