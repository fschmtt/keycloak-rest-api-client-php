<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class ResourceServer extends Representation
{
    public function __construct(
        ?bool $allowRemoveResourceManagement = null,
        ?string $clientId = null,
        ?DecisionStrategy $decisionStrategy = null,
        ?string $id = null,
        ?string $name = null,
        ?array $policies = null,
        ?PolicyEnforcementMode $policyEnforcementMode = null,
        ?array $resources = null,
        ?array $scopes = null,
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