<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class User
{
    /**
     * @var array|null
     */
    private $access;

    /**
     * @var array|null
     */
    private $attributes;

    /**
     * @var UserConsent[]|null
     */
    private $clientConsents;

    /**
     * @var array|null
     */
    private $clientRoles;

    /**
     * @var int|null
     */
    private $createdTimestamp;

    /**
     * @var Credential[]|null
     */
    private $credentials;

    /**
     * @var string[]|null
     */
    private $disableableCredentialTypes;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var bool|null
     */
    private $emailVerified;

    /**
     * @var bool|null
     */
    private $enabled;

    /**
     * @var FederatedIdentity[]
     */
    private $federatedIdentities;

    /**
     * @var string|null
     */
    private $federationLink;

    /**
     * @var string|null
     */
    private $firstName;

    /**
     * @var string[]|null
     */
    private $groups;

    /**
     * @var string|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $lastName;

    /**
     * @var int|null
     */
    private $notBefore;

    /**
     * @var string|null
     */
    private $origin;

    /**
     * @var string[]|null
     */
    private $realmRoles;

    /**
     * @var string[]|null
     */
    private $requiredActions;

    /**
     * @var string|null
     */
    private $self;

    /**
     * @var string|null
     */
    private $serviceAccountClientId;

    /**
     * @var string|null
     */
    private $username;

    /**
     * @param array|null $access
     * @param array|null $attributes
     * @param array|null $clientConsents
     * @param array|null $clientRoles
     * @param int|null $createdTimestamp
     * @param array|null $credentials
     * @param array|null $disableableCredentialTypes
     * @param string|null $email
     * @param bool|null $emailVerified
     * @param bool|null $enabled
     * @param array|null $federatedIdentities
     * @param string|null $federationLink
     * @param string|null $firstName
     * @param array|null $groups
     * @param string|null $id
     * @param string|null $lastName
     * @param int|null $notBefore
     * @param string|null $origin
     * @param array|null $realmRoles
     * @param array|null $requiredActions
     * @param string|null $self
     * @param string|null $serviceAccountClientId
     * @param string|null $username
     */
    public function __construct(
        ?array $access,
        ?array $attributes,
        ?array $clientConsents,
        ?array $clientRoles,
        ?int $createdTimestamp,
        ?array $credentials,
        ?array $disableableCredentialTypes,
        ?string $email,
        ?bool $emailVerified,
        ?bool $enabled,
        ?array $federatedIdentities,
        ?string $federationLink,
        ?string $firstName,
        ?array $groups,
        ?string $id,
        ?string $lastName,
        ?int $notBefore,
        ?string $origin,
        ?array $realmRoles,
        ?array $requiredActions,
        ?string $self,
        ?string $serviceAccountClientId,
        ?string $username
    ) {
        $this->access = $access;
        $this->attributes = $attributes;
        $this->clientConsents = $clientConsents;
        $this->clientRoles = $clientRoles;
        $this->createdTimestamp = $createdTimestamp;
        $this->credentials = $credentials;
        $this->disableableCredentialTypes = $disableableCredentialTypes;
        $this->email = $email;
        $this->emailVerified = $emailVerified;
        $this->enabled = $enabled;
        $this->federatedIdentities = $federatedIdentities;
        $this->federationLink = $federationLink;
        $this->firstName = $firstName;
        $this->groups = $groups;
        $this->id = $id;
        $this->lastName = $lastName;
        $this->notBefore = $notBefore;
        $this->origin = $origin;
        $this->realmRoles = $realmRoles;
        $this->requiredActions = $requiredActions;
        $this->self = $self;
        $this->serviceAccountClientId = $serviceAccountClientId;
        $this->username = $username;
    }

    /**
     * @return array|null
     */
    public function getAccess(): ?array
    {
        return $this->access;
    }

    /**
     * @return array|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @return UserConsent[]|null
     */
    public function getClientConsents(): ?array
    {
        return $this->clientConsents;
    }

    /**
     * @return array|null
     */
    public function getClientRoles(): ?array
    {
        return $this->clientRoles;
    }

    /**
     * @return int|null
     */
    public function getCreatedTimestamp(): ?int
    {
        return $this->createdTimestamp;
    }

    /**
     * @return Credential[]|null
     */
    public function getCredentials(): ?array
    {
        return $this->credentials;
    }

    /**
     * @return string[]|null
     */
    public function getDisableableCredentialTypes(): ?array
    {
        return $this->disableableCredentialTypes;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return bool|null
     */
    public function getEmailVerified(): ?bool
    {
        return $this->emailVerified;
    }

    /**
     * @return bool|null
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @return FederatedIdentity[]
     */
    public function getFederatedIdentities(): array
    {
        return $this->federatedIdentities;
    }

    /**
     * @return string|null
     */
    public function getFederationLink(): ?string
    {
        return $this->federationLink;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string[]|null
     */
    public function getGroups(): ?array
    {
        return $this->groups;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return int|null
     */
    public function getNotBefore(): ?int
    {
        return $this->notBefore;
    }

    /**
     * @return string|null
     */
    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    /**
     * @return string[]|null
     */
    public function getRealmRoles(): ?array
    {
        return $this->realmRoles;
    }

    /**
     * @return string[]|null
     */
    public function getRequiredActions(): ?array
    {
        return $this->requiredActions;
    }

    /**
     * @return string|null
     */
    public function getSelf(): ?string
    {
        return $this->self;
    }

    /**
     * @return string|null
     */
    public function getServiceAccountClientId(): ?string
    {
        return $this->serviceAccountClientId;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }
}
