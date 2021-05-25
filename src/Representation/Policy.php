<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class Policy extends Representation
{
    protected ?array $config;

    protected ?DecisionStrategy $decisionStrategy;

    protected ?string $description;

    protected ?string $id;

    protected ?Logic $logic;

    protected ?string $name;

    protected ?string $owner;

    /**
     * @var Policy[]|null
     */
    protected ?array $policies;

    /**
     * @var string[]|null
     */
    protected ?array $resources;

    /**
     * @var Resource[]|null
     */
    protected ?array $resourcesData;

    /**
     * @var string[]|null
     */
    protected ?array $scopes;

    /**
     * @var Scope[]|null
     */
    protected ?array $scopesData;

    protected ?string $type;
}
