<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\PolicyCollection;
use Fschmtt\Keycloak\Collection\ResourceCollection;
use Fschmtt\Keycloak\Collection\ScopeCollection;
use Fschmtt\Keycloak\Enum\DecisionStrategy;
use Fschmtt\Keycloak\Enum\PolicyEnforcementMode;

/**
 * @method bool|null getAllowRemoveResourceManagement()
 * @method string|null getClientId()
 * @method DecisionStrategy|null getDecisionStrategy()
 * @method string|null getId()
 * @method string|null getName()
 * @method PolicyCollection|null getPolicies()
 * @method PolicyEnforcementMode|null getPolicyEnforcementMode()
 * @method ResourceCollection|null getResources()
 * @method ScopeCollection|null getScopes()
 * @method self withAllowRemoveResourceManagement(?bool $allowRemoveResourceManagement)
 * @method self withClientId(?string $clientId)
 * @method self withDecisionStrategy(?DecisionStrategy $decisionStrategy)
 * @method self withId(?string $id)
 * @method self withName(?string $name)
 * @method self withPolicies(?PolicyCollection $policies)
 * @method self withPolicyEnforcementMode(?PolicyEnforcementMode $policyEnforcementMode)
 * @method self withResources(?ResourceCollection $resources)
 * @method self withScopes(?ScopeCollection $scopes)
 *
 * @codeCoverageIgnore
 */
class ResourceServer extends Representation
{
    public function __construct(
        ?bool $allowRemoveResourceManagement = null,
        ?string $clientId = null,
        ?DecisionStrategy $decisionStrategy = null,
        ?string $id = null,
        ?string $name = null,
        ?PolicyCollection $policies = null,
        ?PolicyEnforcementMode $policyEnforcementMode = null,
        ?ResourceCollection $resources = null,
        ?ScopeCollection $scopes = null,
    ) {
        parent::__construct(
            $allowRemoveResourceManagement,
            $clientId,
            $decisionStrategy,
            $id,
            $name,
            $policies,
            $policyEnforcementMode,
            $resources,
            $scopes,
        );
    }
}
