<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Exception;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Representation\Role;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestBehaviour;
use PHPUnit\Framework\TestCase;

class RolesTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testCreateRetrieveUpdateDeleteRole(): void
    {
        $resource = $this->getKeycloak()->roles();

        // Get all roles
        $allRoles = $resource->all(realm: 'master');
        static::assertGreaterThanOrEqual(1, $allRoles->count());
        $role = $allRoles->first();
        static::assertInstanceOf(Role::class, $role);

        // Create role
        $resource->create(
            new Role(name: 'test-role', description: 'test-role-description'),
            'master',
        );

        // Search (created) role
        $role = $resource->all(new Criteria([
            'search' => 'test-role',
        ]), 'master')->first();
        static::assertInstanceOf(Role::class, $role);
        static::assertEquals('test-role', $role->getName());

        // Get single (created) role
        $role = $resource->get('test-role', 'master');
        static::assertSame('test-role', $role->getName());

        // Update (created) role
        $resource->update($role->withDescription('updated-test-role-description'), 'master');

        // Delete (created) role
        $resource->delete('test-role', 'master');

        try {
            $resource->get('test-role', 'master');
            static::fail('Role should not exist anymore');
        } catch (Exception $e) {
            static::assertSame(404, $e->getCode());
        }
    }
}
