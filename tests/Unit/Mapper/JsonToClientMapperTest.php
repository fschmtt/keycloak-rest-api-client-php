<?php

namespace Fschmtt\Keycloak\Mapper;

use Fschmtt\Keycloak\Representation\Client;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Mapper\JsonToClientMapper
 */
class JsonToClientMapperTest extends TestCase
{
    public function testMapJsonToClient()
    {
        $json = json_encode([
            'baseUrl' => 'https://my.app/',
            'clientId' => 'my-client-uuid',
            'id' => 'my-client-id',
            'name' => 'my-client-name'
        ]);

        $mapper = new JsonToClientMapper();

        $this->assertEquals(
            new Client(
                'https://my.app/',
                'my-client-uuid',
                'my-client-id',
                'my-client-name'
            ),
            $mapper->mapJsonToClient($json)
        );
    }
}
