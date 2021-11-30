<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Fschmtt\Keycloak\Representation\ServerInfo;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestBehaviour;
use PHPUnit\Framework\TestCase;

class ServerInfoTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testCanGetServerInfo(): void
    {
        $serverInfo = $this->getKeycloak()->serverInfo()->get();

        static::assertInstanceOf(ServerInfo::class, $serverInfo);
    }
}
