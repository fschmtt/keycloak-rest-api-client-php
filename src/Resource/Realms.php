<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\KeysMetadata;
use Fschmtt\Keycloak\Representation\Realm;

/**
 * @phpstan-type AdminEvent array<mixed>
 */
class Realms extends Resource
{
    public function all(?Criteria $criteria = null): RealmCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms',
                RealmCollection::class,
                criteria: $criteria,
            ),
        );
    }

    public function get(?string $realm = null): Realm
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}',
                Realm::class,
                [
                    'realm' => $realm,
                ],
            ),
        );
    }

    public function import(Realm $realm): Realm
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms',
                Method::POST,
                payload: $realm,
            ),
        );

        return $this->get($realm->getRealm());
    }

    public function update(Realm $updatedRealm, ?string $realm = null): Realm
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}',
                Method::PUT,
                [
                    'realm' => $realm,
                ],
                $updatedRealm,
            ),
        );

        return $this->get($updatedRealm->getRealm());
    }

    public function delete(?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}',
                Method::DELETE,
                [
                    'realm' => $realm,
                ],
            ),
        );
    }

    /**
     * @return AdminEvent[]
     */
    public function adminEvents(?Criteria $criteria = null, ?string $realm = null): array
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/admin-events',
                'array',
                [
                    'realm' => $realm,
                ],
                $criteria,
            ),
        );
    }

    public function keys(?Criteria $criteria = null, ?string $realm = null): KeysMetadata
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/keys',
                KeysMetadata::class,
                [
                    'realm' => $realm,
                ],
                $criteria,
            ),
        );
    }

    public function deleteAdminEvents(?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/admin-events',
                Method::DELETE,
                [
                    'realm' => $realm,
                ],
            ),
        );
    }

    public function clearKeysCache(?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clear-keys-cache',
                Method::POST,
                [
                    'realm' => $realm,
                ],
            ),
        );
    }

    public function clearRealmCache(?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clear-realm-cache',
                Method::POST,
                [
                    'realm' => $realm,
                ],
            ),
        );
    }

    public function clearUserCache(?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clear-user-cache',
                Method::POST,
                [
                    'realm' => $realm,
                ],
            ),
        );
    }
}
