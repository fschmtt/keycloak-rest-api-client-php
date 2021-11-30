<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Fschmtt\Keycloak\Representation\ServerInfo;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestCase;

class ServerInfoTest extends IntegrationTestCase
{
    public function testCanGetServerInfo(): void
    {
        $serverInfo = $this->keycloak->serverInfo()->get();

        static::assertInstanceOf(ServerInfo::class, $serverInfo);
    }
}
