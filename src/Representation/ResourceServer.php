<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\PolicyCollection;
use Fschmtt\Keycloak\Collection\ResourceCollection;
use Fschmtt\Keycloak\Collection\ScopeCollection;
use Fschmtt\Keycloak\Enum\DecisionStrategy;
use Fschmtt\Keycloak\Enum\PolicyEnforcementMode;

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
