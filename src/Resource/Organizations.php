<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Collection\OrganizationCollection;
use Fschmtt\Keycloak\Collection\OrganizationInvitationCollection;
use Fschmtt\Keycloak\Collection\OrganizationMemberCollection;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\ContentType;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Representation\Organization;
use Fschmtt\Keycloak\Representation\OrganizationInvitation;
use Fschmtt\Keycloak\Representation\OrganizationMember;

class Organizations extends Resource
{
    public function all(string $realm, ?Criteria $criteria = null): OrganizationCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/organizations',
                OrganizationCollection::class,
                ['realm' => $realm],
                $criteria,
            ),
        );
    }

    public function get(string $realm, string $id): Organization
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/organizations/{id}',
                Organization::class,
                ['realm' => $realm, 'id' => $id],
            ),
        );
    }

    public function create(string $realm, Organization $organization): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/organizations',
                Method::POST,
                ['realm' => $realm],
                $organization,
            ),
        );
    }

    public function createAndGetId(string $realm, Organization $organization): ?string
    {
        $response = $this->commandExecutor->executeCommandWithResponse(
            new Command(
                '/admin/realms/{realm}/organizations',
                Method::POST,
                ['realm' => $realm],
                $organization,
            ),
        );

        $path = parse_url($response->getHeaderLine('Location'), PHP_URL_PATH);

        return is_string($path) && $path !== '' ? basename($path) : null;
    }

    public function update(string $realm, string $id, Organization $organization): void
    {
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

    public function delete(string $realm, string $id): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/organizations/{id}',
                Method::DELETE,
                ['realm' => $realm, 'id' => $id],
            ),
        );
    }

    public function inviteUser(string $realm, string $id, string $email, string $firstName, string $lastName): void
    {
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

    public function addUser(string $realm, string $organizationId, string $userId): void
    {
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

    public function members(string $realm, string $organizationId, ?Criteria $criteria = null): OrganizationMemberCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/organizations/{organizationId}/members',
                OrganizationMemberCollection::class,
                ['realm' => $realm, 'organizationId' => $organizationId],
                $criteria,
            ),
        );
    }

    public function member(string $realm, string $organizationId, string $userId): OrganizationMember
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/organizations/{organizationId}/members/{userId}',
                OrganizationMember::class,
                ['realm' => $realm, 'organizationId' => $organizationId, 'userId' => $userId],
            ),
        );
    }

    public function removeUser(string $realm, string $organizationId, string $userId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/organizations/{organizationId}/members/{userId}',
                Method::DELETE,
                ['realm' => $realm, 'organizationId' => $organizationId, 'userId' => $userId],
            ),
        );
    }

    public function invitations(string $realm, string $organizationId, ?Criteria $criteria = null): OrganizationInvitationCollection
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/organizations/{organizationId}/invitations',
                OrganizationInvitationCollection::class,
                ['realm' => $realm, 'organizationId' => $organizationId],
                $criteria,
            ),
        );
    }

    public function invitation(string $realm, string $organizationId, string $invitationId): OrganizationInvitation
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/organizations/{organizationId}/invitations/{invitationId}',
                OrganizationInvitation::class,
                ['realm' => $realm, 'organizationId' => $organizationId, 'invitationId' => $invitationId],
            ),
        );
    }

    public function resendInvitation(string $realm, string $organizationId, string $invitationId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/organizations/{organizationId}/invitations/{invitationId}/resend',
                Method::POST,
                ['realm' => $realm, 'organizationId' => $organizationId, 'invitationId' => $invitationId],
            ),
        );
    }

    public function deleteInvitation(string $realm, string $organizationId, string $invitationId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/organizations/{organizationId}/invitations/{invitationId}',
                Method::DELETE,
                ['realm' => $realm, 'organizationId' => $organizationId, 'invitationId' => $invitationId],
            ),
        );
    }
}
