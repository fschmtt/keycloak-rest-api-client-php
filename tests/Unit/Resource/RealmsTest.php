<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\Representation\Group;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\User;
use Fschmtt\Keycloak\Resource\Realms;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Resource\Realms
 */
class RealmsTest extends TestCase
{
    public function testGetAllRealms(): void
    {
        $query = new Query(
            '/admin/realms?briefRepresentation={briefRepresentation}',
            RealmCollection::class,
            [
                'briefRepresentation' => true,
            ],
        );

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn(
                new RealmCollection([
                    new Realm(realm: 'realm-1'),
                    new Realm(realm: 'realm-2'),
                ])
            );

        $realms = new Realms(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );
        $realms = $realms->all();

        static::assertInstanceOf(RealmCollection::class, $realms);
        static::assertCount(2, $realms);
    }

    public function testImportRealm(): void
    {
        $command = new Command(
            '/admin/realms',
            Method::POST,
            [],
            new Realm(realm: 'imported-realm'),
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $query = new Query(
            '/admin/realms/{realm}?briefRepresentation={briefRepresentation}',
            Realm::class,
            [
                'realm' => 'imported-realm',
                'briefRepresentation' => true,
            ],
        );

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn(
                new Realm(realm: 'imported-realm')
            );

        $realms = new Realms(
            $commandExecutor,
            $queryExecutor,
        );
        $realm = $realms->import(new Realm(realm: 'imported-realm'));

        static::assertSame('imported-realm', $realm->getRealm());
    }

    public function testUpdateRealm(): void
    {
        $updatedRealm = new Realm(realm: 'updated-realm', displayName: 'Updated Realm');

        $command = new Command(
            '/admin/realms/{realm}',
            Method::PUT,
            [
                'realm' => 'to-be-updated-realm',
            ],
            $updatedRealm,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $query = new Query(
            '/admin/realms/{realm}?briefRepresentation={briefRepresentation}',
            Realm::class,
            [
                'realm' => 'updated-realm',
                'briefRepresentation' => true,
            ],
        );

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn(
                new Realm(
                    displayName: 'Updated Realm',
                    realm: 'updated-realm',
                )
            );

        $realms = new Realms(
            $commandExecutor,
            $queryExecutor,
        );
        $realm = $realms->update('to-be-updated-realm', $updatedRealm);

        static::assertSame('Updated Realm', $realm->getDisplayName());
    }

    public function testDeleteRealm(): void
    {
        $command = new Command(
            '/admin/realms/{realm}',
            Method::DELETE,
            [
                'realm' => 'to-be-deleted-realm',
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $realms = new Realms(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );
        $realms->delete('to-be-deleted-realm');
    }

    public function testGetUsers(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/users',
            UserCollection::class,
            [
                'realm' => 'realm-with-users',
            ],
        );

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn(
                new UserCollection([
                    new User(id: 'user-1'),
                    new User(id: 'user-2'),
                ]),
            );

        $realms = new Realms(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );
        $users = $realms->users('realm-with-users');

        static::assertCount(2, $users);
        static::assertInstanceOf(User::class, $users->first());
        static::assertSame('user-1', $users->first()->getId());
    }

    public function testGetGroups(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/groups?briefRepresentation={briefRepresentation}',
            GroupCollection::class,
            [
                'realm' => 'realm-with-groups',
                'briefRepresentation' => true,
            ],
        );

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn(
                new GroupCollection([
                    new Group(id: 'group-1'),
                    new Group(id: 'group-2'),
                ]),
            );

        $realms = new Realms(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );
        $groups = $realms->groups('realm-with-groups');

        static::assertCount(2, $groups);
        static::assertInstanceOf(Group::class, $groups->first());
        static::assertSame('group-1', $groups->first()->getId());
    }

    public function testGetAdminEvents(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/admin-events',
            'array',
            [
                'realm' => 'realm-with-admin-events',
            ],
        );

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn([
                [], [],
            ]);

        $realms = new Realms(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );
        $adminEvents = $realms->adminEvents('realm-with-admin-events');

        static::assertCount(2, $adminEvents);
    }

    public function testDeleteAdminEvents(): void
    {
        $command = new Command(
            '/admin/realms/{realm}/admin-events',
            Method::DELETE,
            [
                'realm' => 'realm-with-admin-events',
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $realms = new Realms(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );
        $realms->deleteAdminEvents('realm-with-admin-events');
    }

    public function testClearKeysCache(): void
    {
        $command = new Command(
            '/admin/realms/{realm}/clear-keys-cache',
            Method::POST,
            [
                'realm' => 'realm-with-cache',
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $realms = new Realms(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );
        $realms->clearKeysCache('realm-with-cache');
    }

    public function testClearRealmCache(): void
    {
        $command = new Command(
            '/admin/realms/{realm}/clear-realm-cache',
            Method::POST,
            [
                'realm' => 'realm-with-cache',
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $realms = new Realms(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );
        $realms->clearRealmCache('realm-with-cache');
    }

    public function testClearUserCache(): void
    {
        $command = new Command(
            '/admin/realms/{realm}/clear-user-cache',
            Method::POST,
            [
                'realm' => 'realm-with-cache',
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $realms = new Realms(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );
        $realms->clearUserCache('realm-with-cache');
    }
}
