<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Collection\OrganizationCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\ContentType;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\Representation\Organization;
use Fschmtt\Keycloak\Resource\AttackDetection;
use Fschmtt\Keycloak\Resource\Organizations;
use Fschmtt\Keycloak\Type\Map;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Organizations::class)]
class OrganizationsTest extends TestCase
{
    public function testGetAllOrganizations(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/organizations',
            OrganizationCollection::class,
            [
                'realm' => 'test-realm',
            ],
        );

        $organizationCollection = new OrganizationCollection([
            new Organization(id: 'test-organization-1'),
            new Organization(id: 'test-organization-2'),
        ]);

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($organizationCollection);

        $organizations = new Organizations(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        static::assertSame(
            $organizationCollection,
            $organizations->all('test-realm'),
        );
    }

    public function testGetOrganization(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/organizations/{id}',
            Organization::class,
            [
                'realm' => 'test-realm',
                'id' => 'test-organization-1',
            ],
        );

        $organization = new Organization(id: 'test-organization-1');

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn($organization);

        $organizations = new Organizations(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );

        static::assertSame(
            $organization,
            $organizations->get('test-realm', 'test-organization-1'),
        );
    }

    public function testCreateOrganization(): void
    {
        $createdOrganization = new Organization(id: 'uuid', name: 'test-organization-1');

        $command = new Command(
            '/admin/realms/{realm}/organizations',
            Method::POST,
            [
                'realm' => 'test-realm',
            ],
            $createdOrganization,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $organizations = new Organizations(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        $organizations->create('test-realm', $createdOrganization);
    }

    public function testDeleteOrganization(): void
    {
        $deletedOrganization = new Organization(id: 'uuid', name: 'test-organization-1');

        $command = new Command(
            '/admin/realms/{realm}/organizations/{id}',
            Method::DELETE,
            [
                'realm' => 'test-realm',
                'id' => 'uuid',
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $organizations = new Organizations(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        $organizations->delete('test-realm', 'uuid');
    }

    public function testInviteUser(): void
    {
        $command = new Command(
            '/admin/realms/{realm}/organizations/{id}/members/invite-user',
            Method::POST,
            [
                'realm' => 'test-realm',
                'id' => 'uuid',
            ],
            [
                'email' => 'email',
                'firstName' => 'first name',
                'lastName' => 'last name',
            ],
            contentType: ContentType::FORM_PARAMS,
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $organizations = new Organizations(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        $organizations->inviteUser('test-realm', 'uuid', 'email', 'first name', 'last name');
    }

    public function testAddUser(): void
    {
        $command = new Command(
            '/admin/realms/{realm}/organizations/{organizationId}/members',
            Method::POST,
            [
                'realm' => 'test-realm',
                'organizationId' => 'organization-id',
            ],
            'user-id',
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $organizations = new Organizations(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );

        $organizations->addUser('test-realm', 'organization-id', 'user-id');
    }
}
