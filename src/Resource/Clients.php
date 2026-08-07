<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\ClientCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\Client as ClientRepresentation;
use Fschmtt\Keycloak\Representation\Credential;

/**
 * @phpstan-type UserSession array<mixed>
 */
class Clients extends Resource
{
    public function all(?Criteria $criteria = null, ?string $realm = null): ClientCollection
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/clients',
                ClientCollection::class,
                [
                    'realm' => $realm,
                ],
                $criteria,
            ),
        );
    }

    public function get(string $clientUuid, ?string $realm = null): ClientRepresentation
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/clients/{clientUuid}',
                ClientRepresentation::class,
                [
                    'realm' => $realm,
                    'clientUuid' => $clientUuid,
                ],
            ),
        );
    }

    public function import(ClientRepresentation $client, ?string $realm = null): ClientRepresentation
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clients',
                Method::POST,
                [
                    'realm' => $realm,
                ],
                $client,
            ),
        );

        return $this->get($client->getId(), $realm);
    }

    public function update(string $clientUuid, ClientRepresentation $updatedClient, ?string $realm = null): ClientRepresentation
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clients/{clientUuid}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'clientUuid' => $clientUuid,
                ],
                $updatedClient,
            ),
        );

        return $this->get($updatedClient->getId(), $realm);
    }

    public function delete(string $clientUuid, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clients/{clientUuid}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'clientUuid' => $clientUuid,
                ],
            ),
        );
    }

    /**
     * @return UserSession[]
     */
    public function getUserSessions(string $clientUuid, ?Criteria $criteria = null, ?string $realm = null): array
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/clients/{clientUuid}/user-sessions',
                'array',
                [
                    'realm' => $realm,
                    'clientUuid' => $clientUuid,
                ],
                $criteria,
            ),
        );
    }

    public function getClientSecret(string $clientUuid, ?string $realm = null): Credential
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/clients/{clientUuid}/client-secret',
                Credential::class,
                [
                    'realm' => $realm,
                    'clientUuid' => $clientUuid,
                ],
            ),
        );
    }
}
