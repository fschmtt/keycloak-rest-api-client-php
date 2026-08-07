<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\CredentialCollection;
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
    public function all(?Criteria $criteria = null, ?string $realm = null): UserCollection
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users',
                UserCollection::class,
                [
                    'realm' => $realm,
                ],
                $criteria,
            ),
        );
    }

    public function get(string $userId, ?string $realm = null): UserRepresentation
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}',
                UserRepresentation::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
            ),
        );
    }

    public function create(UserRepresentation $user, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users',
                Method::POST,
                [
                    'realm' => $realm,
                ],
                $user,
            ),
        );
    }

    public function update(string $userId, UserRepresentation $updatedUser, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
                $updatedUser,
            ),
        );
    }

    public function delete(string $userId, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
            ),
        );
    }

    public function search(?Criteria $criteria = null, ?string $realm = null): UserCollection
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users',
                UserCollection::class,
                [
                    'realm' => $realm,
                ],
                $criteria,
            ),
        );
    }

    public function joinGroup(string $userId, string $groupId, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/groups/{groupId}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                    'groupId' => $groupId,
                ],
            ),
        );
    }

    public function leaveGroup(string $userId, string $groupId, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/groups/{groupId}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                    'groupId' => $groupId,
                ],
            ),
        );
    }

    public function retrieveGroups(string $userId, ?Criteria $criteria = null, ?string $realm = null): GroupCollection
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}/groups',
                GroupCollection::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
                $criteria,
            ),
        );
    }

    public function retrieveRealmRoles(string $userId, ?string $realm = null): RoleCollection
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}/role-mappings/realm',
                RoleCollection::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
            ),
        );
    }

    public function retrieveAvailableRealmRoles(string $userId, ?string $realm = null): RoleCollection
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}/role-mappings/realm/available',
                RoleCollection::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
            ),
        );
    }

    public function addRealmRoles(string $userId, RoleCollection $roles, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/role-mappings/realm',
                Method::POST,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
                $roles,
            ),
        );
    }

    public function removeRealmRoles(string $userId, RoleCollection $roles, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/role-mappings/realm',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
                $roles,
            ),
        );
    }


    public function retrieveClientRoles(string $userId, string $clientUuid, ?string $realm = null): RoleCollection
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}/role-mappings/clients/{clientUuid}',
                RoleCollection::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                    'clientUuid' => $clientUuid,
                ],
            ),
        );
    }

    public function retrieveAvailableClientRoles(string $userId, string $clientUuid, ?string $realm = null): RoleCollection
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}/role-mappings/clients/{clientUuid}/available',
                RoleCollection::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                    'clientUuid' => $clientUuid,
                ],
            ),
        );
    }

    public function addClientRoles(string $userId, RoleCollection $roles, string $clientUuid, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/role-mappings/clients/{clientUuid}',
                Method::POST,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                    'clientUuid' => $clientUuid,
                ],
                $roles,
            ),
        );
    }

    public function removeClientRoles(string $userId, RoleCollection $roles, string $clientUuid, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/role-mappings/clients/{clientUuid}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                    'clientUuid' => $clientUuid,
                ],
                $roles,
            ),
        );
    }

    /**
     * @param list<string>|null $actions
     */
    public function executeActionsEmail(string $userId, ?array $actions = null, ?Criteria $criteria = null, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{userId}/execute-actions-email',
                Method::PUT,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
                $actions,
                $criteria,
            ),
        );
    }

    public function credentials(string $userId, ?string $realm = null): CredentialCollection
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{userId}/credentials',
                CredentialCollection::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ],
            ),
        );
    }
}
