<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\Realm;

class Realms extends Resource
{
    public function all(bool $briefRepresentation = true): RealmCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms?briefRepresentation={briefRepresentation}',
                RealmCollection::class,
                [
                    'briefRepresentation' => $briefRepresentation,
                ]
            )
        );
    }

    public function get(string $realm, bool $briefRepresentation = true): Realm
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}?briefRepresentation={briefRepresentation}',
                Realm::class,
                [
                    'realm' => $realm,
                    'briefRepresentation' => $briefRepresentation,
                ]
            )
        );
    }

    public function import(Realm $realm): Realm
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms',
                Method::POST,
                [],
                $realm,
            )
        );

        return $this->get($realm->getRealm());
    }

    public function update(string $realm, Realm $updatedRealm): Realm
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}',
                Method::PUT,
                [
                    'realm' => $realm,
                ],
                $updatedRealm,
            )
        );

        return $this->get($updatedRealm->getRealm());
    }

    public function delete(string $realm): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}',
                Method::DELETE,
                [
                    'realm' => $realm,
                ],
            )
        );
    }

    public function users(string $realm): UserCollection
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

    public function groups(string $realm, bool $briefRepresentation = true): GroupCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/groups?briefRepresentation={briefRepresentation}',
                GroupCollection::class,
                [
                    'realm' => $realm,
                    'briefRepresentation' => $briefRepresentation,
                ],
            )
        );
    }

    public function adminEvents(string $realm): array
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/admin-events',
                'array',
                [
                    'realm' => $realm,
                ],
            )
        );
    }

    public function deleteAdminEvents(string $realm): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/admin-events',
                Method::DELETE,
                [
                    'realm' => $realm,
                ],
            )
        );
    }

    public function clearKeysCache(string $realm): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clear-keys-cache',
                Method::POST,
                [
                    'realm' => $realm,
                ],
            )
        );
    }

    public function clearRealmCache(string $realm): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clear-realm-cache',
                Method::POST,
                [
                    'realm' => $realm,
                ],
            )
        );
    }

    public function clearUserCache(string $realm): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clear-user-cache',
                Method::POST,
                [
                    'realm' => $realm,
                ],
            )
        );
    }
}
