<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Json\JsonDecoder;
use Fschmtt\Keycloak\Representation\KeysMetadata;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Uri\UriResolver;
use InvalidArgumentException;

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

    /**
     * @param Realm|string $realmOrFile Representation of the realm or path to the JSON file
     * @param string|null $name Name of the realm. Only required if the first parameter is a path to a JSON file
     * @return Realm
     * @throws FilesystemException
     * @throws JsonDecodeException
     */
    public function import(Realm|string $realmOrFile, ?string $name = null): Realm
    {
        $realm = is_string($realmOrFile) ? $this->parseJson($realmOrFile, $name) : $realmOrFile;
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

    private function parseJson(string $path, ?string $name): Realm
    {
        $content = (new UriResolver())->resolve($path);
        $data = (new JsonDecoder())->decode($content);
        if (!array_is_list($data)) {
            return Realm::from($data);
        }
        if ($name === null) {
            throw new InvalidArgumentException('The name of the realm is required when importing from an array');
        }

        $result = null;
        foreach ($data as $realm) {
            if ($realm['realm'] === $name) {
                $result = Realm::from($realm);
            }
        }

        if ($result === null) {
            throw new InvalidArgumentException('The realm with the given name was not found');
        }

        return $result;
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

    /**
     * @return AdminEvent[]
     */
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
    
    public function keys(string $realm, ?Criteria $criteria = null): KeysMetadata
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/keys',
                KeysMetadata::class,
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
