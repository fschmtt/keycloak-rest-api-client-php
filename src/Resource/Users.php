<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Collection\RoleCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\User as UserRepresentation;

class Users extends Resource
{
    public function all(string $realm, ?Criteria $criteria = null): UserCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users',
                UserCollection::class,
                [
                    'realm' => $realm,
                ],
                $criteria
            )
        );
    }

    public function get(string $realm, string $userId): UserRepresentation
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}',
                UserRepresentation::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ]
            )
        );
    }

    public function create(string $realm, UserRepresentation $user): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users',
                Method::POST,
                [
                    'realm' => $realm,
                ],
                $user,
            )
        );
    }

    public function update(string $realm, string $userId, UserRepresentation $updatedUser): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
                $updatedUser,
            )
        );
    }

    public function delete(string $realm, string $userId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
            )
        );
    }

    public function search(string $realm, ?Criteria $criteria = null): UserCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users',
                UserCollection::class,
                [
                    'realm' => $realm,
                ],
                $criteria
            )
        );
    }

    public function joinGroup(string $realm, string $userId, string $groupId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/groups/{groupId}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                    'groupId' => $groupId,
                ]
            )
        );
    }

    public function leaveGroup(string $realm, string $userId, string $groupId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/groups/{groupId}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                    'groupId' => $groupId,
                ]
            )
        );
    }

    public function retrieveGroups(string $realm, string $userId, ?Criteria $criteria = null): GroupCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}/groups',
                GroupCollection::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
                $criteria
            )
        );
    }

    public function retrieveRealmRoles(string $realm, string $userId): RoleCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}/role-mappings/realm',
                RoleCollection::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ]
            )
        );
    }

    public function retrieveAvailableRealmRoles(string $realm, string $userId): RoleCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}/role-mappings/realm/available',
                RoleCollection::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ]
            )
        );
    }

    public function addRealmRoles(string $realm, string $userId, array $roles): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/role-mappings/realm',
                Method::POST,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
                $roles
            )
        );
    }

    public function removeRealmRoles(string $realm, string $userId, array $roles): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/role-mappings/realm',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
                $roles
            )
        );
    }
}
