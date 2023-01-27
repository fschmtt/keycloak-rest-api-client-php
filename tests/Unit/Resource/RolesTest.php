<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Collection\RoleCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\Representation\Role;
use Fschmtt\Keycloak\Resource\Roles;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Resource\Roles
 */
class RolesTest extends TestCase
{
    public function testGetAllRoles(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/roles',
            RoleCollection::class,
            [
                'realm' => 'test-realm',
            ],
        );

        $clientCollection = new RoleCollection([
            new Role(id: 'test-role-1'),
            new Role(id: 'test-role-2'),
        ]);

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($clientCollection);

        $clients = new Roles(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        static::assertSame(
            $clientCollection,
            $clients->all('test-realm')
        );
    }

    public function testGetRole(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/roles/{roleName}',
            Role::class,
            [
                'realm' => 'test-realm',
                'roleName' => 'test-role',
            ],
        );

        $client = new Role(id: 'test-role-1');

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($client);

        $clients = new Roles(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        static::assertSame(
            $client,
            $clients->get('test-realm', 'test-role')
        );
    }

    public function testCreateRole(): void
    {
        $createdRole = new Role(id: 'uuid', name: 'created-role');

        $command = new Command(
            '/admin/realms/{realm}/roles',
            Method::POST,
            [
                'realm' => 'test-realm',
            ],
            $createdRole,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $roles = new Roles(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        $roles->create('test-realm', $createdRole);
    }

    public function testDeleteRole(): void
    {
        $deletedRole = new Role(name: 'deleted-role');

        $command = new Command(
            '/admin/realms/{realm}/roles/{roleName}',
            Method::DELETE,
            [
                'realm' => 'test-realm',
                'roleName' => $deletedRole->getName(),
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $roles = new Roles(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        $roles->delete('test-realm', $deletedRole->getName());
    }
}
