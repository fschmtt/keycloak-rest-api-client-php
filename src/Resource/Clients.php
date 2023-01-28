<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\ClientCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\Client as ClientRepresentation;

/**
 * @phpstan-type UserSession array<mixed>
 */
class Clients extends Resource
{
    public function all(string $realm, ?Criteria $criteria = null): ClientCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/clients',
                ClientCollection::class,
                [
                    'realm' => $realm,
                ],
                $criteria,
            )
        );
    }

    public function get(string $realm, string $clientId): ClientRepresentation
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/clients/{clientId}',
                ClientRepresentation::class,
                [
                    'realm' => $realm,
                    'clientId' => $clientId,
                ]
            )
        );
    }

    public function import(string $realm, ClientRepresentation $client): ClientRepresentation
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clients',
                Method::POST,
                [
                    'realm' => $realm,
                ],
                $client,
            )
        );

        return $this->get($realm, $client->getId());
    }

    public function update(string $realm, string $clientId, ClientRepresentation $updatedClient): ClientRepresentation
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clients/{clientId}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'clientId' => $clientId,
                ],
                $updatedClient,
            )
        );

        return $this->get($realm, $updatedClient->getId());
    }

    public function delete(string $realm, string $clientId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clients/{clientId}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'clientId' => $clientId,
                ],
            )
        );
    }

    /**
     * @return UserSession[]
     */
    public function getUserSessions(string $realm, string $clientId, ?Criteria $criteria = null): array
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/clients/{clientId}/user-sessions',
                'array',
                [
                    'realm' => $realm,
                    'clientId' => $clientId,
                ],
                $criteria,
            )
        );
    }
}
