<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\Group;

class Groups extends Resource
{
    public function all(string $realm, ?Criteria $criteria = null): GroupCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/groups',
                GroupCollection::class,
                [
                    'realm' => $realm,
                ],
                $criteria,
            ),
        );
    }

    public function byPath(string $realm, string $path = ''): Group
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/group-by-path/{path}',
                Group::class,
                [
                    'realm' => $realm,
                    'path' => $path,
                ],
            ),
        );
    }

    public function children(string $realm, string $groupId, ?Criteria $criteria = null): GroupCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/groups/{groupId}/children',
                GroupCollection::class,
                [
                    'realm' => $realm,
                    'groupId' => $groupId,
                ],
                $criteria,
            ),
        );
    }

    public function members(string $realm, string $groupId, ?Criteria $criteria = null): UserCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/groups/{groupId}/members',
                UserCollection::class,
                [
                    'realm' => $realm,
                    'groupId' => $groupId,
                ],
                $criteria,
            ),
        );
    }

    public function get(string $realm, string $groupId): Group
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/groups/{groupId}',
                Group::class,
                [
                    'realm' => $realm,
                    'groupId' => $groupId,
                ],
            ),
        );
    }

    public function create(string $realm, Group $group): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/groups',
                Method::POST,
                [
                    'realm' => $realm,
                ],
                $group,
            ),
        );
    }

    public function createChild(string $realm, Group $group, string $parentGroupId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/groups/{groupId}/children',
                Method::POST,
                [
                    'realm' => $realm,
                    'groupId' => $parentGroupId,
                ],
                $group,
            ),
        );
    }

    public function update(string $realm, string $groupId, Group $updatedGroup): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/groups/{groupId}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'groupId' => $groupId,
                ],
                $updatedGroup,
            ),
        );
    }

    public function delete(string $realm, string $groupId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/groups/{groupId}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'groupId' => $groupId,
                ],
            ),
        );
    }
}
