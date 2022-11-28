<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Collection\ClientCollection;
use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\PropertyFilter\PropertyFilter;
use Fschmtt\Keycloak\Representation\Client as ClientRepresentation;
use Fschmtt\Keycloak\Representation\Group;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\User;
use Fschmtt\Keycloak\Resource\Realms;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Resource\Realms
 */
class RealmsTest extends TestCase
{
    public function testGetAllRealms(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('GET', '/admin/realms')
            ->willReturn(new Response(
                status: 200,
                body: json_encode([
                    [
                        'realm' => 'test-realm',
                    ],
                    [
                        'realm' => 'test-realm-2',
                    ],
                ], JSON_THROW_ON_ERROR)
            ));

        $realms = new Realms($httpClient, new PropertyFilter());
        $realms = $realms->all();

        static::assertInstanceOf(RealmCollection::class, $realms);
        static::assertCount(2, $realms);
    }

    public function testCanImportRealm(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::exactly(2))
            ->method('request')
            ->withConsecutive(['POST', '/admin/realms'], ['GET', '/admin/realms/imported-realm'])
            ->willReturnOnConsecutiveCalls(
                new Response(
                    status: 201,
                ),
                new Response(
                    status: 200,
                    body: json_encode([
                        'realm' => 'imported-realm',
                    ], JSON_THROW_ON_ERROR)
                )
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $realm = $realms->import(new Realm(realm: 'imported-realm'));

        static::assertInstanceOf(Realm::class, $realm);
        static::assertSame('imported-realm', $realm->getRealm());
    }

    public function testUpdateRealm(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::exactly(2))
            ->method('request')
            ->withConsecutive(['PUT', '/admin/realms/imported-realm'], ['GET', '/admin/realms/imported-realm'])
            ->willReturnOnConsecutiveCalls(
                new Response(
                    status: 204,
                ),
                new Response(
                    status: 200,
                    body: json_encode([
                        'realm' => 'imported-realm',
                        'displayName' => 'Imported Realm',
                    ], JSON_THROW_ON_ERROR)
                )
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $realm = $realms->update(new Realm(realm: 'imported-realm', displayName: 'Imported Realm'));

        static::assertInstanceOf(Realm::class, $realm);
        static::assertSame('Imported Realm', $realm->getDisplayName());
    }

    public function testDeleteRealm(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('DELETE', '/admin/realms/imported-realm')
            ->willReturn(
                new Response(
                    status: 204,
                ),
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $realms->delete(new Realm(realm: 'imported-realm'));
    }

    public function testGetClients(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('GET', '/admin/realms/imported-realm/clients')
            ->willReturn(
                new Response(
                    status: 204,
                    body: json_encode([
                        [
                            'id' => 'client-id',
                        ],
                    ], JSON_THROW_ON_ERROR)
                ),
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $clients = $realms->clients(new Realm(realm: 'imported-realm'));

        static::assertInstanceOf(ClientCollection::class, $clients);
        static::assertCount(1, $clients);
        static::assertInstanceOf(ClientRepresentation::class, $clients->first());
        static::assertSame('client-id', $clients->first()->getId());
    }

    public function testGetClient(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('GET', '/admin/realms/imported-realm/clients/client-id')
            ->willReturn(
                new Response(
                    status: 204,
                    body: json_encode([
                        'id' => 'client-id',
                    ], JSON_THROW_ON_ERROR)
                ),
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $client = $realms->client(new Realm(realm: 'imported-realm'), 'client-id');

        static::assertInstanceOf(ClientRepresentation::class, $client);
        static::assertSame('client-id', $client->getId());
    }

    public function testGetUsers(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('GET', '/admin/realms/imported-realm/users')
            ->willReturn(
                new Response(
                    status: 204,
                    body: json_encode([
                        [
                            'id' => 'user-id-1',
                        ],
                        [
                            'id' => 'user-id-2',
                        ],
                    ], JSON_THROW_ON_ERROR)
                ),
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $users = $realms->users(new Realm(realm: 'imported-realm'));

        static::assertInstanceOf(UserCollection::class, $users);
        static::assertCount(2, $users);
        static::assertInstanceOf(User::class, $users->first());
        static::assertSame('user-id-1', $users->first()->getId());
    }

    public function testGetGroups(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('GET', '/admin/realms/imported-realm/groups?briefRepresentation=false')
            ->willReturn(
                new Response(
                    status: 204,
                    body: json_encode([
                        [
                            'id' => 'group-id-1',
                        ],
                        [
                            'id' => 'group-id-2',
                        ],
                    ], JSON_THROW_ON_ERROR)
                ),
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $groups = $realms->groups(new Realm(realm: 'imported-realm'));

        static::assertInstanceOf(GroupCollection::class, $groups);
        static::assertCount(2, $groups);
        static::assertInstanceOf(Group::class, $groups->first());
        static::assertSame('group-id-1', $groups->first()->getId());
    }

    public function testGetAdminEvents(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('GET', '/admin/realms/imported-realm/admin-events')
            ->willReturn(
                new Response(
                    status: 204,
                    body: json_encode([
                        [],
                        [],
                    ], JSON_THROW_ON_ERROR)
                ),
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $adminEvents = $realms->adminEvents(new Realm(realm: 'imported-realm'));

        static::assertCount(2, $adminEvents);
    }

    public function testDeleteAdminEvents(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('DELETE', '/admin/realms/imported-realm/admin-events')
            ->willReturn(
                new Response(
                    status: 204,
                ),
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $realms->deleteAdminEvents(new Realm(realm: 'imported-realm'));
    }

    public function testClearKeysCache(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('POST', '/admin/realms/imported-realm/clear-keys-cache')
            ->willReturn(
                new Response(
                    status: 204,
                ),
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $realms->clearKeysCache(new Realm(realm: 'imported-realm'));
    }

    public function testClearRealmCache(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('POST', '/admin/realms/imported-realm/clear-realm-cache')
            ->willReturn(
                new Response(
                    status: 204,
                ),
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $realms->clearRealmCache(new Realm(realm: 'imported-realm'));
    }

    public function testClearUserCache(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('POST', '/admin/realms/imported-realm/clear-user-cache')
            ->willReturn(
                new Response(
                    status: 204,
                ),
            );

        $realms = new Realms($httpClient, new PropertyFilter());
        $realms->clearUserCache(new Realm(realm: 'imported-realm'));
    }
}
