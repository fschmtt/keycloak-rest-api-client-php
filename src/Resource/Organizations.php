<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\OrganizationCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\ContentType;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\Organization;

class Organizations extends Resource
{
    public function all(?Criteria $criteria = null, ?string $realm = null): OrganizationCollection
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/organizations',
                OrganizationCollection::class,
                ['realm' => $realm],
                $criteria,
            ),
        );
    }

    public function get(string $id, ?string $realm = null): Organization
    {
        $realm = $this->resolveRealm($realm);

        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/organizations/{id}',
                Organization::class,
                ['realm' => $realm, 'id' => $id],
            ),
        );
    }

    public function create(Organization $organization, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/organizations',
                Method::POST,
                ['realm' => $realm],
                $organization,
            ),
        );
    }

    public function update(string $id, Organization $organization, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/organizations/{id}',
                Method::PUT,
                [
                    'realm' => $realm,
                    'id' => $id,
                ],
                $organization,
            ),
        );
    }

    public function delete(string $id, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/organizations/{id}',
                Method::DELETE,
                ['realm' => $realm, 'id' => $id],
            ),
        );
    }

    public function inviteUser(string $id, string $email, string $firstName, string $lastName, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/organizations/{id}/members/invite-user',
                Method::POST,
                ['realm' => $realm, 'id' => $id],
                payload: [
                    'email' => $email,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                ],
                contentType: ContentType::FORM_PARAMS,
            ),
        );
    }

    public function addUser(string $organizationId, string $userId, ?string $realm = null): void
    {
        $realm = $this->resolveRealm($realm);

        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/organizations/{organizationId}/members',
                Method::POST,
                ['realm' => $realm, 'organizationId' => $organizationId],
                payload: $userId,
                contentType: ContentType::JSON,
            ),
        );
    }
}
