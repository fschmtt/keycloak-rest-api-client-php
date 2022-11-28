<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @codeCoverageIgnore
 */
class IdentityProvider extends Representation
{
    /**
     * @var bool|null
     */
    private $addReadTokenRoleOnCreate;

    /**
     * @var string|null
     */
    private $alias;

    /**
     * @var array|null
     */
    private $config;

    /**
     * @var string|null
     */
    private $displayName;

    /**
     * @var bool|null
     */
    private $enabled;

    /**
     * @var string|null
     */
    private $firstBrokerLoginFlowAlias;

    /**
     * @var string|null
     */
    private $internalId;

    /**
     * @var bool|null
     */
    private $linkOnly;

    /**
     * @var string|null
     */
    private $postBrokerLoginFlowAlias;

    /**
     * @var string|null
     */
    private $providerId;

    /**
     * @var bool|null
     */
    private $storeToken;

    /**
     * @var bool|null
     */
    private $trustEmail;

    /**
     * @param bool|null $addReadTokenRoleOnCreate
     * @param string|null $alias
     * @param array|null $config
     * @param string|null $displayName
     * @param bool|null $enabled
     * @param string|null $firstBrokerLoginFlowAlias
     * @param string|null $internalId
     * @param bool|null $linkOnly
     * @param string|null $postBrokerLoginFlowAlias
     * @param string|null $providerId
     * @param bool|null $storeToken
     * @param bool|null $trustEmail
     */
    public function __construct(
        ?bool $addReadTokenRoleOnCreate,
        ?string $alias,
        ?array $config,
        ?string $displayName,
        ?bool $enabled,
        ?string $firstBrokerLoginFlowAlias,
        ?string $internalId,
        ?bool $linkOnly,
        ?string $postBrokerLoginFlowAlias,
        ?string $providerId,
        ?bool $storeToken,
        ?bool $trustEmail
    ) {
        $this->addReadTokenRoleOnCreate = $addReadTokenRoleOnCreate;
        $this->alias = $alias;
        $this->config = $config;
        $this->displayName = $displayName;
        $this->enabled = $enabled;
        $this->firstBrokerLoginFlowAlias = $firstBrokerLoginFlowAlias;
        $this->internalId = $internalId;
        $this->linkOnly = $linkOnly;
        $this->postBrokerLoginFlowAlias = $postBrokerLoginFlowAlias;
        $this->providerId = $providerId;
        $this->storeToken = $storeToken;
        $this->trustEmail = $trustEmail;
    }

    /**
     * @return bool|null
     */
    public function getAddReadTokenRoleOnCreate(): ?bool
    {
        return $this->addReadTokenRoleOnCreate;
    }

    /**
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @return array|null
     */
    public function getConfig(): ?array
    {
        return $this->config;
    }

    /**
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @return bool|null
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @return string|null
     */
    public function getFirstBrokerLoginFlowAlias(): ?string
    {
        return $this->firstBrokerLoginFlowAlias;
    }

    /**
     * @return string|null
     */
    public function getInternalId(): ?string
    {
        return $this->internalId;
    }

    /**
     * @return bool|null
     */
    public function getLinkOnly(): ?bool
    {
        return $this->linkOnly;
    }

    /**
     * @return string|null
     */
    public function getPostBrokerLoginFlowAlias(): ?string
    {
        return $this->postBrokerLoginFlowAlias;
    }

    /**
     * @return string|null
     */
    public function getProviderId(): ?string
    {
        return $this->providerId;
    }

    /**
     * @return bool|null
     */
    public function getStoreToken(): ?bool
    {
        return $this->storeToken;
    }

    /**
     * @return bool|null
     */
    public function getTrustEmail(): ?bool
    {
        return $this->trustEmail;
    }
}
