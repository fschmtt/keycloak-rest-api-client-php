<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getAccess()
 * @method Map|null getAttributes()
 * @method UserConsent[]|null getClientConsents()
 * @method Map|null getClientRoles()
 * @method int|null getCreatedTimestamp()
 * @method Credential[]|null getCredentials()
 * @method array|null getDisableableCredentialTypes()
 * @method string|null getEmail()
 * @method bool|null getEmailVerified()
 * @method bool|null getEnabled()
 * @method FederatedIdentity[]|null getFederatedIdentities()
 * @method string|null getFederationLink()
 * @method string|null getFirstName()
 * @method array|null getGroups()
 * @method string|null getId()
 * @method string|null getLastName()
 * @method int|null getNotBefore()
 * @method string|null getOrigin()
 * @method array|null getRealmRoles()
 * @method array|null getRequiredActions()
 * @method string|null getSelf()
 * @method string|null getServiceAccountClientId()
 * @method string|null getUsername()
 * @method self withAccess(?Map $access)
 * @method self withAttributes(?Map $attributes)
 * @method self withClientConsents(?array $clientConsents)
 * @method self withClientRoles(?array $clientRoles)
 * @method self withCreatedTimestamp(?int $createdTimestamp)
 * @method self withCredentials(?array $credentials)
 * @method self withDisableableCredentialTypes(?bool $disableableCredentialTypes)
 * @method self withEmail(?string $email)
 * @method self withEmailVerified(?bool $emailVerified)
 * @method self withEnabled(?bool $enabled)
 * @method self withFederatedIdentities(?array $federatedIdentites)
 * @method self withFederationLink(?string $federationLink)
 * @method self withFirstName(?string $firstName)
 * @method self withGroups(?array $groups)
 * @method self withId(?string $id)
 * @method self withLastName(?string $lastName)
 * @method self withNotBefore(?int $notBefore)
 * @method self withOrigin(?string $origin)
 * @method self withRealmRoles(?array $realmRoles)
 * @method self withRequiredActions(?array $requiredActions)
 * @method self withSelf(?string $self)
 * @method self withServiceAccountClientId(?string $serviceAccountClientId)
 * @method self withUsername(?string $username)
*/
class User extends Representation
{
    public function __construct(
        protected ?Map $access = null,
        protected ?Map $attributes = null,
        protected ?array $clientConsents = null,
        protected ?Map $clientRoles = null,
        protected ?int $createdTimestamp = null,
        protected ?array $credentials = null,
        protected ?array $disableableCredentialTypes = null,
        protected ?string $email = null,
        protected ?bool $emailVerified = null,
        protected ?bool $enabled = null,
        protected ?array $federatedIdentities = null,
        protected ?string $federationLink = null,
        protected ?string $firstName = null,
        protected ?array $groups = null,
        protected ?string $id = null,
        protected ?string $lastName = null,
        protected ?int $notBefore = null,
        protected ?string $origin = null,
        protected ?array $realmRoles = null,
        protected ?array $requiredActions = null,
        protected ?string $self = null,
        protected ?string $serviceAccountClientId = null,
        protected ?string $username = null,
    ) {
        parent::__construct(
            $access,
            $attributes,
            $clientConsents,
            $clientRoles,
            $createdTimestamp,
            $credentials,
            $disableableCredentialTypes,
            $email,
            $emailVerified,
            $enabled,
            $federatedIdentities,
            $federationLink,
            $firstName,
            $groups,
            $id,
            $lastName,
            $notBefore,
            $origin,
            $realmRoles,
            $requiredActions,
            $self,
            $serviceAccountClientId,
            $username,
        );
    }
}
