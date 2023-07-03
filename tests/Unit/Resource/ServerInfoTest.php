<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\Representation\ServerInfo as ServerInfoRepresentation;
use Fschmtt\Keycloak\Resource\ServerInfo;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ServerInfo::class)]
class ServerInfoTest extends TestCase
{
    public function testGetServerInfo(): void
    {
        $query = new Query(
            '/admin/serverinfo',
            ServerInfoRepresentation::class,
        );

        $serverInfoRepresentation = new ServerInfoRepresentation();

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($serverInfoRepresentation);

        $serverInfo = new ServerInfo(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        static::assertSame(
            $serverInfoRepresentation,
            $serverInfo->get()
        );
    }
}
