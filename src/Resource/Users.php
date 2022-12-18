<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

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
}
