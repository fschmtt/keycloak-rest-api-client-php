<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Collection\ClientCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\Representation\Client as ClientRepresentation;
use Fschmtt\Keycloak\Resource\Clients;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Resource\Clients
 */
class ClientsTest extends TestCase
{
    public function testGetAllClients(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/clients',
            ClientCollection::class,
            [
                'realm' => 'test-realm',
            ],
        );

        $clientCollection = new ClientCollection([
            new ClientRepresentation(clientId: 'test-client-1'),
            new ClientRepresentation(clientId: 'test-client-2'),
        ]);

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($clientCollection);

        $clients = new Clients(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        static::assertSame(
            $clientCollection,
            $clients->all('test-realm')
        );
    }

    public function testGetClient(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/clients/{clientId}',
            ClientRepresentation::class,
            [
                'realm' => 'test-realm',
                'clientId' => 'test-client',
            ],
        );

        $client = new ClientRepresentation(clientId: 'test-client-1');

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($client);

        $clients = new Clients(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        static::assertSame(
            $client,
            $clients->get('test-realm', 'test-client')
        );
    }

    public function testUpdateClient(): void
    {
        $updatedClient = new ClientRepresentation(clientId: 'updated-client', id: 'uuid');

        $command = new Command(
            '/admin/realms/{realm}/clients/{clientId}',
            Method::PUT,
            [
                'realm' => 'test-realm',
                'clientId' => 'test-client',
            ],
            $updatedClient,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $query = new Query(
            '/admin/realms/{realm}/clients/{clientId}',
            ClientRepresentation::class,
            [
                'realm' => 'test-realm',
                'clientId' => $updatedClient->getId(),
            ],
        );

        $client = new ClientRepresentation(clientId: 'updated-client');

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($client);

        $clients = new Clients(
            $commandExecutor,
            $queryExecutor,
        );

        static::assertSame(
            $client,
            $clients->update('test-realm', 'test-client', $updatedClient)
        );
    }

    public function testImportClient(): void
    {
        $importedClient = new ClientRepresentation(clientId: 'imported-client', id: 'uuid');

        $command = new Command(
            '/admin/realms/{realm}/clients',
            Method::POST,
            [
                'realm' => 'test-realm',
            ],
            $importedClient,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $query = new Query(
            '/admin/realms/{realm}/clients/{clientId}',
            ClientRepresentation::class,
            [
                'realm' => 'test-realm',
                'clientId' => $importedClient->getId(),
            ],
        );

        $client = new ClientRepresentation(clientId: 'updated-client');

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($client);

        $clients = new Clients(
            $commandExecutor,
            $queryExecutor,
        );

        static::assertSame(
            $client,
            $clients->import('test-realm', $importedClient)
        );
    }

    public function testDeleteClient(): void
    {
        $deletedClient = new ClientRepresentation(clientId: 'deleted-client', id: 'uuid');

        $command = new Command(
            '/admin/realms/{realm}/clients/{clientId}',
            Method::DELETE,
            [
                'realm' => 'test-realm',
                'clientId' => $deletedClient->getId(),
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $clients = new Clients(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        $clients->delete('test-realm', $deletedClient->getId());
    }

    public function testGetUserSessions(): void
    {
        $client = new ClientRepresentation(id: 'test-client');

        $query = new Query(
            '/admin/realms/{realm}/clients/{clientId}/user-sessions',
            'array',
            [
                'realm' => 'test-realm',
                'clientId' => $client->getId(),
            ],
        );

        $userSessions = [];

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($userSessions);

        $clients = new Clients(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        static::assertSame(
            $userSessions,
            $clients->getUserSessions('test-realm', $client->getId())
        );
    }
}
