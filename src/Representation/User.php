<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\CredentialCollection;
use Fschmtt\Keycloak\Collection\FederatedIdentityCollection;
use Fschmtt\Keycloak\Collection\UserConsentCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getAccess()
 * @method self withAccess(?Map $access)
 *
 * @method Map|null getAttributes()
 * @method self withAttributes(?Map $attributes)
 *
 * @method UserConsentCollection|null getClientConsents()
 * @method self withClientConsents(?UserConsentCollection $clientConsents)
 *
 * @method Map|null getClientRoles()
 * @method self withClientRoles(?Map $clientRoles)
 *
 * @method int|null getCreatedTimestamp()
 * @method self withCreatedTimestamp(?int $createdTimestamp)
 *
 * @method CredentialCollection|null getCredentials()
 * @method self withCredentials(?CredentialCollection $credentials)
 *
 * @method string[]|null getDisableableCredentialTypes()
 * @method self withDisableableCredentialTypes(?bool $disableableCredentialTypes)
 *
 * @method string|null getEmail()
 * @method self withEmail(?string $email)
 *
 * @method bool|null getEmailVerified()
 * @method self withEmailVerified(?bool $emailVerified)
 *
 * @method bool|null getEnabled()
 * @method self withEnabled(?bool $enabled)
 *
 * @method FederatedIdentityCollection|null getFederatedIdentities()
 * @method self withFederatedIdentities(?FederatedIdentityCollection $federatedIdentites)
 *
 * @method string|null getFederationLink()
 * @method self withFederationLink(?string $federationLink)
 *
 * @method string|null getFirstName()
 * @method self withFirstName(?string $firstName)
 *
 * @method string[]|null getGroups()
 * @method self withGroups(?string[] $groups)
 *
 * @method string|null getId()
 * @method self withId(?string $id)
 *
 * @method string|null getLastName()
 * @method self withLastName(?string $lastName)
 *
 * @method int|null getNotBefore()
 * @method self withNotBefore(?int $notBefore)
 *
 * @method string|null getOrigin()
 * @method self withOrigin(?string $origin)
 *
 * @method string[]|null getRealmRoles()
 * @method self withRealmRoles(?string[] $realmRoles)
 *
 * @method string[]|null getRequiredActions()
 * @method self withRequiredActions(?string[] $requiredActions)
 *
 * @method string|null getSelf()
 * @method self withSelf(?string $self)
 *
 * @method string|null getServiceAccountClientId()
 * @method self withServiceAccountClientId(?string $serviceAccountClientId)
 *
 * @method bool|null getTotp()
 * @method self withTotp(?bool $totp)
 *
 * @method string|null getUsername()
 * @method self withUsername(?string $username)
 *
 * @codeCoverageIgnore
*/
class User extends Representation
{
    public function __construct(
        protected ?Map $access = null,
        protected ?Map $attributes = null,
        protected ?UserConsentCollection $clientConsents = null,
        protected ?Map $clientRoles = null,
        protected ?int $createdTimestamp = null,
        protected ?CredentialCollection $credentials = null,
        /** @var string[]|null */
        protected ?array $disableableCredentialTypes = null,
        protected ?string $email = null,
        protected ?bool $emailVerified = null,
        protected ?bool $enabled = null,
        protected ?FederatedIdentityCollection $federatedIdentities = null,
        protected ?string $federationLink = null,
        protected ?string $firstName = null,
        /** @var string[]|null */
        protected ?array $groups = null,
        protected ?string $id = null,
        protected ?string $lastName = null,
        protected ?int $notBefore = null,
        protected ?string $origin = null,
        /** @var string[]|null */
        protected ?array $realmRoles = null,
        /** @var string[]|null */
        protected ?array $requiredActions = null,
        protected ?string $self = null,
        protected ?string $serviceAccountClientId = null,
        protected ?bool $totp = null,
        protected ?string $username = null,
    ) {}
}
