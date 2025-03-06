<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\Representation\Group;
use Fschmtt\Keycloak\Representation\User;
use Fschmtt\Keycloak\Resource\Groups;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Groups::class)]
class GroupsTest extends TestCase
{
    public function testGetAllGroups(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/groups',
            GroupCollection::class,
            [
                'realm' => 'realm-with-groups',
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

        $groups = new Groups(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );
        $groups = $groups->all('realm-with-groups');

        static::assertCount(2, $groups);
        static::assertInstanceOf(Group::class, $groups->first());
        static::assertSame('group-1', $groups->first()->getId());
    }

    public function testGetGroupChildren(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/groups/{groupId}/children',
            GroupCollection::class,
            [
                'realm' => 'realm-with-groups',
                'groupId' => 'child-group-id',
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

        $groups = new Groups(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );
        $groups = $groups->children('realm-with-groups', 'child-group-id');

        static::assertCount(2, $groups);
        static::assertInstanceOf(Group::class, $groups->first());
        static::assertSame('group-1', $groups->first()->getId());
    }

    public function testGetGroup(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/groups/{groupId}',
            Group::class,
            [
                'realm' => 'realm-with-groups',
                'groupId' => 'group-1',
            ],
        );

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn(new Group(id: 'group-1'));

        $groups = new Groups(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        $group = $groups->get('realm-with-groups', 'group-1');
        static::assertSame('group-1', $group->getId());
    }

    public function testCreateGroup(): void
    {
        $group = new Group(name: 'imported-group');

        $command = new Command(
            '/admin/realms/{realm}/groups',
            Method::POST,
            [
                'realm' => 'realm-with-groups',
            ],
            $group,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command)
            ->willReturn(new Response(204, [
                'Location' => '/admin/realms/realm-with-groups/groups/uuid',
            ]));

        $groups = $this->getMockBuilder(Groups::class)
            ->setConstructorArgs([$commandExecutor, $this->createMock(QueryExecutor::class)])
            ->onlyMethods(['get'])
            ->getMock();
        $groups->expects(static::once())
            ->method('get')
            ->with('realm-with-groups', 'uuid')
            ->willReturn(new Group(id: 'uuid'));

        $group = $groups->create('realm-with-groups', $group);

        self::assertInstanceOf(Group::class, $group);
        self::assertSame('uuid', $group->getId());
    }

    public function testCreateChildGroup(): void
    {
        $group = new Group(name: 'child-group');

        $command = new Command(
            '/admin/realms/{realm}/groups/{groupId}/children',
            Method::POST,
            [
                'realm' => 'realm-with-groups',
                'groupId' => 'parent-group-id',
            ],
            $group,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command)
            ->willReturn(new Response(204, [
                'Location' => '/admin/realms/realm-with-groups/groups/uuid',
            ]));

        $groups = $this->getMockBuilder(Groups::class)
            ->setConstructorArgs([$commandExecutor, $this->createMock(QueryExecutor::class)])
            ->onlyMethods(['get'])
            ->getMock();
        $groups->expects(static::once())
            ->method('get')
            ->with('realm-with-groups', 'uuid')
            ->willReturn(new Group(id: 'uuid'));

        $group = $groups->createChild('realm-with-groups', $group, 'parent-group-id');

        self::assertInstanceOf(Group::class, $group);
        self::assertSame('uuid', $group->getId());
    }

    public function testUpdateGroup(): void
    {
        $group = new Group(id: 'group-id', name: 'updated-group');

        $command = new Command(
            '/admin/realms/{realm}/groups/{groupId}',
            Method::PUT,
            [
                'realm' => 'realm-with-groups',
                'groupId' => 'group-id',
            ],
            $group,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command)
            ->willReturn($mockResponse = new Response());

        $groups = new Groups(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        $response = $groups->update('realm-with-groups', $group->getId(), $group);

        $this->assertSame($mockResponse, $response);
    }

    public function testDeleteGroup(): void
    {
        $group = new Group(id: 'group-id', name: 'updated-group');

        $command = new Command(
            '/admin/realms/{realm}/groups/{groupId}',
            Method::DELETE,
            [
                'realm' => 'realm-with-groups',
                'groupId' => 'group-id',
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command)
            ->willReturn($mockResponse = new Response());

        $groups = new Groups(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        $response = $groups->delete('realm-with-groups', $group->getId());

        $this->assertSame($mockResponse, $response);
    }

    public function testByPath(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/group-by-path/{path}',
            Group::class,
            [
                'realm' => 'realm-with-groups',
                'path' => 'path/to/group',
            ],
        );

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn(new Group(id: 'group-1'));

        $groups = new Groups(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        $group = $groups->byPath('realm-with-groups', 'path/to/group');
        static::assertSame('group-1', $group->getId());
    }

    public function testMembers(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/groups/{groupId}/members',
            UserCollection::class,
            [
                'realm' => 'realm-with-groups',
                'groupId' => 'group-1',
            ],
        );

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn(new UserCollection([new User(id: 'user-1')]));

        $groups = new Groups(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        $members = $groups->members('realm-with-groups', 'group-1');
        static::assertCount(1, $members);
    }

    public function testCreateGroupWithoutResponseHeaderLocation(): void
    {
        $group = new Group(name: 'child-group');

        $command = new Command(
            '/admin/realms/{realm}/groups',
            Method::POST,
            [
                'realm' => 'realm-with-groups',
            ],
            $group,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command)
            ->willReturn(new Response(204, [
                // 'Location' => '/admin/realms/realm-with-groups/groups/uuid',
            ]));

        $groups = new Groups(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        self::expectExceptionMessage('Could not extract group id from response');

        $groups->create('realm-with-groups', $group);

        self::fail('Expected exception not thrown');
    }

    public function testCreateChildGroupWithoutResponseHeaderLocation(): void
    {
        $group = new Group(name: 'child-group');

        $command = new Command(
            '/admin/realms/{realm}/groups/{groupId}/children',
            Method::POST,
            [
                'realm' => 'realm-with-groups',
                'groupId' => 'parent-group-id',
            ],
            $group,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command)
            ->willReturn(new Response(204, [
                // 'Location' => '/admin/realms/realm-with-groups/groups/uuid',
            ]));

        $groups = new Groups(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        self::expectExceptionMessage('Could not extract group id from response');

        $groups->createChild('realm-with-groups', $group, 'parent-group-id');

        self::fail('Expected exception not thrown');
    }
}
