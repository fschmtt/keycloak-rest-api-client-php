<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\CredentialCollection;
use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Collection\RoleCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\ContentType;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\User as UserRepresentation;
use Psr\Http\Message\ResponseInterface;

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
                $criteria,
            ),
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
                ],
            ),
        );
    }

    public function create(string $realm, UserRepresentation $user): UserRepresentation
    {
        $response = $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users',
                Method::POST,
                [
                    'realm' => $realm,
                ],
                $user,
            ),
        );

        $userId = $this->getIdFromResponse($response);

        if ($userId === null) {
            throw new \RuntimeException('Could not extract user id from response');
        }

        return $this->get($realm, $userId);
    }

    public function update(string $realm, string $userId, UserRepresentation $updatedUser): UserRepresentation
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
            ),
        );

        return $this->get($realm, $userId);
    }

    public function delete(string $realm, string $userId): ResponseInterface
    {
        return $this->commandExecutor->executeCommand(
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

    public function search(string $realm, ?Criteria $criteria = null): UserCollection
    {
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

    public function joinGroup(string $realm, string $userId, string $groupId): ResponseInterface
    {
        return $this->commandExecutor->executeCommand(
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

    public function leaveGroup(string $realm, string $userId, string $groupId): ResponseInterface
    {
        return $this->commandExecutor->executeCommand(
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
                $criteria,
            ),
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
                ],
            ),
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
                ],
            ),
        );
    }

    public function addRealmRoles(string $realm, string $userId, RoleCollection $roles): ResponseInterface
    {
        return $this->commandExecutor->executeCommand(
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

    public function removeRealmRoles(string $realm, string $userId, RoleCollection $roles): ResponseInterface
    {
        return $this->commandExecutor->executeCommand(
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

    /**
     * @param list<string>|null $actions
     */
    public function executeActionsEmail(string $realm, string $userId, ?array $actions = null, ?Criteria $criteria = null): ResponseInterface
    {
        return $this->commandExecutor->executeCommand(
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

    public function credentials(string $realm, string $userId): CredentialCollection
    {
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

    public function getIdFromResponse(ResponseInterface $response): ?string
    {
        //Location: http://keycloak:8080/admin/realms/master/users/999a5022-e757-4f5f-ba0e-1d3ccd601c34
        $location = $response->getHeaderLine('Location');

        preg_match('~/users/(?<id>[a-z0-9\-]+)$~', $location, $matches);

        return $matches['id'] ?? null;
    }
}
