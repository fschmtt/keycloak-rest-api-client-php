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
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Roles::class)]
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
            $clients->all('test-realm'),
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
            $clients->get('test-realm', 'test-role'),
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

        $roles = $this->getMockBuilder(Roles::class)
            ->setConstructorArgs([$commandExecutor, $this->createMock(QueryExecutor::class)])
            ->onlyMethods(['get'])
            ->getMock();
        $roles->expects(static::once())
            ->method('get')
            ->with('test-realm', $createdRole->getName())
            ->willReturn($createdRole);

        $role = $roles->create('test-realm', $createdRole);

        static::assertSame($createdRole->getName(), $role->getName());
    }

    public function testDeleteRole(): void
    {
        $deletedRole = new Role(name: 'deleted-role');
        $deletedRoleName = $deletedRole->getName();

        static::assertIsString($deletedRoleName);

        $command = new Command(
            '/admin/realms/{realm}/roles/{roleName}',
            Method::DELETE,
            [
                'realm' => 'test-realm',
                'roleName' => $deletedRoleName,
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command)
            ->willReturn(new Response(204));

        $roles = new Roles(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        $response = $roles->delete('test-realm', $deletedRoleName);

        static::assertSame(204, $response->getStatusCode());
    }

    public function testUpdateRole(): void
    {
        $updatedRole = new Role(name: 'updated-role');
        $updatedRoleName = $updatedRole->getName();

        static::assertIsString($updatedRoleName);

        $command = new Command(
            '/admin/realms/{realm}/roles/{roleName}',
            Method::PUT,
            [
                'realm' => 'test-realm',
                'roleName' => $updatedRoleName,
            ],
            $updatedRole,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $roles = $this->getMockBuilder(Roles::class)
            ->setConstructorArgs([$commandExecutor, $this->createMock(QueryExecutor::class)])
            ->onlyMethods(['get'])
            ->getMock();
        $roles->expects(static::once())
            ->method('get')
            ->with('test-realm', $updatedRole->getName())
            ->willReturn($updatedRole);

        $role = $roles->update('test-realm', $updatedRole);

        static::assertSame($updatedRole->getName(), $role->getName());
    }
}
