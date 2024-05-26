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

    public function get(string $realm, string $clientUuid): ClientRepresentation
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/clients/{clientUuid}',
                ClientRepresentation::class,
                [
                    'realm' => $realm,
                    'clientUuid' => $clientUuid,
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

    public function update(string $realm, string $clientUuid, ClientRepresentation $updatedClient): ClientRepresentation
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clients/{clientUuid}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'clientUuid' => $clientUuid,
                ],
                $updatedClient,
            )
        );

        return $this->get($realm, $updatedClient->getId());
    }

    public function delete(string $realm, string $clientUuid): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/clients/{clientUuid}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'clientUuid' => $clientUuid,
                ],
            )
        );
    }

    /**
     * @return UserSession[]
     */
    public function getUserSessions(string $realm, string $clientUuid, ?Criteria $criteria = null): array
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/clients/{clientUuid}/user-sessions',
                'array',
                [
                    'realm' => $realm,
                    'clientUuid' => $clientUuid,
                ],
                $criteria,
            )
        );
    }
}
