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
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Clients::class)]
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
            '/admin/realms/{realm}/clients/{clientUuid}',
            ClientRepresentation::class,
            [
                'realm' => 'test-realm',
                'clientUuid' => 'test-client',
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
        $updatedClientId = $updatedClient->getId();

        static::assertIsString($updatedClientId);

        $command = new Command(
            '/admin/realms/{realm}/clients/{clientUuid}',
            Method::PUT,
            [
                'realm' => 'test-realm',
                'clientUuid' => 'test-client',
            ],
            $updatedClient,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $query = new Query(
            '/admin/realms/{realm}/clients/{clientUuid}',
            ClientRepresentation::class,
            [
                'realm' => 'test-realm',
                'clientUuid' => $updatedClientId,
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
        $importedClientId = $importedClient->getId();

        static::assertIsString($importedClientId);

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
            '/admin/realms/{realm}/clients/{clientUuid}',
            ClientRepresentation::class,
            [
                'realm' => 'test-realm',
                'clientUuid' => $importedClientId,
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
        $deletedClientId = $deletedClient->getId();

        static::assertIsString($deletedClientId);

        $command = new Command(
            '/admin/realms/{realm}/clients/{clientUuid}',
            Method::DELETE,
            [
                'realm' => 'test-realm',
                'clientUuid' => $deletedClientId,
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

        $clients->delete('test-realm', $deletedClientId);
    }

    public function testGetUserSessions(): void
    {
        $client = new ClientRepresentation(id: 'test-client');
        $clientId = $client->getId();

        static::assertIsString($clientId);

        $query = new Query(
            '/admin/realms/{realm}/clients/{clientUuid}/user-sessions',
            'array',
            [
                'realm' => 'test-realm',
                'clientUuid' => $clientId,
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
            $clients->getUserSessions('test-realm', $clientId)
        );
    }
}
