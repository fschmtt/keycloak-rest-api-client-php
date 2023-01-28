<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ResourceCollection;
use Fschmtt\Keycloak\Collection\ScopeCollection;
use Fschmtt\Keycloak\Enum\DecisionStrategy;
use Fschmtt\Keycloak\Enum\Logic;
use Fschmtt\Keycloak\Type\Map;

/**
 * @codeCoverageIgnore
 */
class Policy extends Representation
{
    public function __construct(
        protected ?Map $config,
        protected ?DecisionStrategy $decisionStrategy,
        protected ?string $description,
        protected ?string $id,
        protected ?Logic $logic,
        protected ?string $name,
        protected ?string $owner,
        protected ?array $policies,
        protected ?ResourceCollection $resources,
        protected ?array $resourcesData,
        protected ?array $scopes,
        protected ?ScopeCollection $scopesData,
        protected ?string $type,
    ) {
    }
}
