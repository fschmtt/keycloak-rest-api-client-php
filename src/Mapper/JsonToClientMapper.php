<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Mapper;

use Fschmtt\Keycloak\Representation\Client;

class JsonToClientMapper
{
    public function mapJsonToClient(string $json): Client
    {
        $json = json_decode($json, true);

        return new Client(
            $json['baseUrl'],
            $json['clientId'],
            $json['id'],
            $json['name']
        );
    }
}
