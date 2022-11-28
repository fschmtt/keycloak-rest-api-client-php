<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\PropertyFilter\PropertyFilter;
use Fschmtt\Keycloak\Resource\ServerInfo;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Resource\ServerInfo
 */
class ServerInfoTest extends TestCase
{
    public function testGetServerInfo(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('GET', '/admin/serverinfo')
            ->willReturn(new Response(
                status: 200,
                body: json_encode([], JSON_THROW_ON_ERROR)
            ));

        $serverInfo = new ServerInfo($httpClient, new PropertyFilter());
        $serverInfo->get();
    }
}
