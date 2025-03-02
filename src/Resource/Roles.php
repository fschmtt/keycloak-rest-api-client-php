<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\RoleCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\Role;

class Roles extends Resource
{
    public function all(string $realm, ?Criteria $criteria = null): RoleCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/roles',
                RoleCollection::class,
                [
                    'realm' => $realm,
                ],
                $criteria,
            ),
        );
    }

    public function get(string $realm, string $roleName): Role
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/roles/{roleName}',
                Role::class,
                [
                    'realm' => $realm,
                    'roleName' => $roleName,
                ],
            ),
        );
    }

    public function create(string $realm, Role $role): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/roles',
                Method::POST,
                [
                    'realm' => $realm,
                ],
                $role,
            ),
        );
    }

    public function delete(string $realm, string $roleName): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/roles/{roleName}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'roleName' => $roleName,
                ],
            ),
        );
    }

    public function update(string $realm, Role $role): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/roles/{roleName}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'roleName' => $role->getName(),
                ],
                $role,
            ),
        );
    }
}
