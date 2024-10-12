<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method bool|null getAddReadTokenRoleOnCreate()
 * @method self withAddReadTokenRoleOnCreate(?bool $addReadTokenRoleOnCreate)
 * @method string|null getAlias()
 * @method self withAlias(?string $alias)
 * @method Map|null getConfig()
 * @method self withConfig(?Map $config)
 * @method string|null getDisplayName()
 * @method self withDisplayName(?string $displayName)
 * @method bool|null getEnabled()
 * @method self withEnabled(?bool $enabled)
 * @method string|null getFirstBrokerLoginFlowAlias()
 * @method self withFirstBrokerLoginFlowAlias(?string $firstBrokerLoginFlowAlias)
 * @method string|null getInternalId()
 * @method self withInternalId(?string $internalId)
 * @method bool|null getLinkOnly()
 * @method self withLinkOnly(?bool $linkOnly)
 * @method string|null getPostBrokerLoginFlowAlias()
 * @method self withPostBrokerLoginFlowAlias(?string $postBrokerLoginFlowAlias)
 * @method string|null getProviderId()
 * @method self withProviderId(?string $providerId)
 * @method bool|null getStoreToken()
 * @method self withStoreToken(?bool $storeToken)
 * @method bool|null getTrustEmail()
 * @method self withTrustEmail(?bool $trustEmail)
 *
 * @codeCoverageIgnore
 */
class IdentityProvider extends Representation
{
    public function __construct(
        protected ?bool $addReadTokenRoleOnCreate = null,
        protected ?string $alias = null,
        protected ?Map $config = null,
        protected ?string $displayName = null,
        protected ?bool $enabled = null,
        protected ?string $firstBrokerLoginFlowAlias = null,
        protected ?string $internalId = null,
        protected ?bool $linkOnly = null,
        protected ?string $postBrokerLoginFlowAlias = null,
        protected ?string $providerId = null,
        protected ?bool $storeToken = null,
        protected ?bool $trustEmail = null,
    ) {}
}
