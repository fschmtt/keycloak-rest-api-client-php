<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\CredentialCollection;
use Fschmtt\Keycloak\Collection\FederatedIdentityCollection;
use Fschmtt\Keycloak\Collection\UserConsentCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getAccess()
 * @method Map|null getAttributes()
 * @method UserConsentCollection|null getClientConsents()
 * @method Map|null getClientRoles()
 * @method int|null getCreatedTimestamp()
 * @method CredentialCollection|null getCredentials()
 * @method array|null getDisableableCredentialTypes()
 * @method string|null getEmail()
 * @method bool|null getEmailVerified()
 * @method bool|null getEnabled()
 * @method FederatedIdentityCollection|null getFederatedIdentities()
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
 * @method bool|null getTotp()
 * @method string|null getUsername()
 * @method self withAccess(?Map $access)
 * @method self withAttributes(?Map $attributes)
 * @method self withClientConsents(?UserConsentCollection $clientConsents)
 * @method self withClientRoles(?array $clientRoles)
 * @method self withCreatedTimestamp(?int $createdTimestamp)
 * @method self withCredentials(?CredentialCollection $credentials)
 * @method self withDisableableCredentialTypes(?bool $disableableCredentialTypes)
 * @method self withEmail(?string $email)
 * @method self withEmailVerified(?bool $emailVerified)
 * @method self withEnabled(?bool $enabled)
 * @method self withFederatedIdentities(?FederatedIdentityCollection $federatedIdentites)
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
 * @method self withTotp(?bool $totp)
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
    ) {
    }
}
