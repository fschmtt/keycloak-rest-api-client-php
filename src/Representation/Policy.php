<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ResourceCollection;
use Fschmtt\Keycloak\Collection\ScopeCollection;
use Fschmtt\Keycloak\Enum\DecisionStrategy;
use Fschmtt\Keycloak\Enum\Logic;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getConfig()
 * @method self withConfig(?Map $config)
 * @method DecisionStrategy|null getDecisionStrategy()
 * @method self withDecisionStrategy(?DecisionStrategy $decisionStrategy)
 * @method string|null getDescription()
 * @method self withDescription(?string $description)
 * @method string|null getId()
 * @method self withId(?string $id)
 * @method Logic|null getLogic()
 * @method self withLogic(?Logic $logic)
 * @method string|null getName()
 * @method self withName(?string $name)
 * @method string|null getOwner()
 * @method self withOwner(?string $owner)
 * @method string[]|null getPolicies()
 * @method self withPolicies(?array $policies)
 * @method string[]|null getResources()
 * @method self withResources(?array $resources)
 * @method ResourceCollection|null getResourcesData()
 * @method self withResourcesData(?ResourceCollection $resourcesData)
 * @method string[]|null getScopes()
 * @method self withScopes(?array $scopes)
 * @method ScopeCollection|null getScopesData()
 * @method self withScopesData(?ScopeCollection $scopesData)
 * @method string|null getType()
 * @method self withType(?string $type)
 *
 * @codeCoverageIgnore
 */
class Policy extends Representation
{
    public function __construct(
        protected ?Map $config = null,
        protected ?DecisionStrategy $decisionStrategy = null,
        protected ?string $description = null,
        protected ?string $id = null,
        protected ?Logic $logic = null,
        protected ?string $name = null,
        protected ?string $owner = null,
        /** @var string[]|null */
        protected ?array $policies = null,
        /** @var string[]|null */
        protected ?array $resources = null,
        protected ?ResourceCollection $resourcesData = null,
        /** @var string[]|null */
        protected ?array $scopes = null,
        protected ?ScopeCollection $scopesData = null,
        protected ?string $type = null,
    ) {
    }
}
