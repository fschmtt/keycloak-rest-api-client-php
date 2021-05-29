<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

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
        protected ?array $resources,
        protected ?array $resourcesData,
        protected ?array $scopes,
        protected ?array $scopesData,
        protected ?string $type,
    ) {
        parent::__construct(
            $this->config,
            $this->decisionStrategy,
            $this->description,
            $this->id,
            $this->logic,
            $this->name,
            $this->owner,
            $this->policies,
            $this->resources,
            $this->resourcesData,
            $this->scopes,
            $this->scopesData,
            $this->type
        );
    }

    public static function from(array $properties): static
    {
        foreach ($properties as $property => $value) {
            if ($property === 'config') {
                $properties[$property] = new Map($value);
            }

            if ($property === 'logic') {
                $properties[$property] = Logic::from($value);
            }

            if ($property === 'resourcesData') {
                $resourcesData = [];

                foreach ($value as $resource) {
                    $resourcesData[] = Resource::from($resource);
                }

                $properties[$property] = $resourcesData;
            }

            if ($property === 'scopesData') {
                $scopesData = [];

                foreach ($value as $scope) {
                    $scopesData[] = Resource::from($scope);
                }

                $properties[$property] = $scopesData;
            }
        }

        return parent::from($properties);
    }
}
