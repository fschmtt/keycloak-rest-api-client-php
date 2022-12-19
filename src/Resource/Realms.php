<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\Realm;

class Realms extends Resource
{
    public function all(?Criteria $criteria = null): RealmCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms',
                RealmCollection::class,
                criteria: $criteria,
            )
        );
    }

    public function get(string $realm): Realm
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}',
                Realm::class,
                [
                    'realm' => $realm,
                ],
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

    public function adminEvents(string $realm, ?Criteria $criteria = null): array
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/admin-events',
                'array',
                [
                    'realm' => $realm,
                ],
                $criteria,
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
