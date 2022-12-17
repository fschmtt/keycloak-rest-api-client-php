<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\User as UserRepresentation;

class Users extends Resource
{
    public function all(string $realm): UserCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users',
                UserCollection::class,
                [
                    'realm' => $realm,
                ],
            )
        );
    }

    public function get(string $realm, string $userId): UserRepresentation
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/users/{id}',
                ClientRepresentation::class,
                [
                    'realm' => $realm,
                    'id' => $userId,
                ]
            )
        );
    }

    public function import(string $realm, UserRepresentation $user): UserRepresentation
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
        
        return $this->get($realm, $user->getId());
    }

    public function update(string $realm, string $userId, UserRepresentation $updatedUser): UserRepresentation
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{id}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'id' => $userId,
                ],
                $updatedUser,
            )
        );

        return $this->get($realm, $updatedUser->getId());
    }

    public function delete(string $realm, string $userId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/users/{id}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'id' => $userId,
                ],
            )
        );
    }
}
