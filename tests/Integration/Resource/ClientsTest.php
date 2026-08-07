<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Exception;
use Fschmtt\Keycloak\Representation\Client;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestBehaviour;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ClientsTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testImportUpdateDeleteClient(): void
    {
        $resource = $this->getKeycloak()->clients();

        // Get all clients
        $allClients = $resource->all(realm: 'master');
        static::assertGreaterThanOrEqual(1, $allClients->count());
        $client = $allClients->first();
        static::assertInstanceOf(Client::class, $client);

        // Import client
        $importedClient = $resource->import(
            $client->withId(Uuid::uuid4()->toString())
                ->withClientId('imported-client')
                ->withDescription('Imported client'),
            'master',
        );

        // Get single (imported) client
        $importedClient = $resource->get($importedClient->getId(), 'master');
        static::assertSame('Imported client', $importedClient->getDescription());

        // Update (imported) client
        $updatedClient = $resource->update($importedClient->getId(), $importedClient->withDescription('Updated client'), 'master');
        static::assertSame('Updated client', $updatedClient->getDescription());

        // Delete (imported) client
        $resource->delete($updatedClient->getId(), 'master');

        try {
            $resource->get($updatedClient->getId(), 'master');
            static::fail('Client should not exist anymore');
        } catch (Exception $e) {
            static::assertSame(404, $e->getCode());
        }
    }

    public function testGetUserSessions(): void
    {
        $resource = $this->getKeycloak()->clients();

        $client = $resource->all(realm: 'master')->first();
        static::assertInstanceOf(Client::class, $client);

        $resource->getUserSessions($client->getId(), realm: 'master');
    }

    public function testGetClientSecret(): void
    {
        $resource = $this->getKeycloak()->clients();

        $client = $resource->all(realm: 'master')->first();
        static::assertInstanceOf(Client::class, $client);

        $clientUuid = $client->getId();
        static::assertIsString($clientUuid);

        $credential = $resource->getClientSecret($clientUuid, 'master');
    }
}
