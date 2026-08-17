<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\CredentialCollection;
use Fschmtt\Keycloak\Collection\FederatedIdentityCollection;
use Fschmtt\Keycloak\Collection\UserConsentCollection;
use Fschmtt\Keycloak\Enum\MembershipType;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getAccess()
 * @method Map|null getAttributes()
 * @method UserConsentCollection|null getClientConsents()
 * @method Map|null getClientRoles()
 * @method int|null getCreatedTimestamp()
 * @method CredentialCollection|null getCredentials()
 * @method string[]|null getDisableableCredentialTypes()
 * @method string|null getEmail()
 * @method bool|null getEmailVerified()
 * @method bool|null getEnabled()
 * @method FederatedIdentityCollection|null getFederatedIdentities()
 * @method string|null getFederationLink()
 * @method string|null getFirstName()
 * @method string[]|null getGroups()
 * @method string|null getId()
 * @method string|null getLastName()
 * @method MembershipType|null getMembershipType()
 * @method int|null getNotBefore()
 * @method string|null getOrigin()
 * @method string[]|null getRealmRoles()
 * @method string[]|null getRequiredActions()
 * @method string|null getSelf()
 * @method string|null getServiceAccountClientId()
 * @method bool|null getTotp()
 * @method string|null getUsername()
 *
 * @codeCoverageIgnore
 */
class OrganizationMember extends Representation
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
        protected ?MembershipType $membershipType = null,
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
