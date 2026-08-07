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
    public function all(?Criteria $criteria = null, ?string $realm = null): RoleCollection
    {
        $realm = $this->resolveRealm($realm);

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

    public function get(string $roleName, ?string $realm = null): Role
    {
        $realm = $this->resolveRealm($realm);

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

    public function create(Role $role, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

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

    public function delete(string $roleName, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

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

    public function update(Role $role, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

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
