<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\PropertyFilter;

use Fschmtt\Keycloak\Representation\Representation;

class PropertyFilter
{
    private string $version;

    /**
     * @var array<class-string, PropertyFilterInterface>
     */
    private array $filters;

    public function __construct(string $version, array $filters = [])
    {
        $this->version = $version;
        $this->filters = $filters;
    }

    /**
     * @param array<string, mixed> $properties
     * @param class-string<Representation> $representation
     * @return array
     */
    public function filter(array $properties, string $representation): array
    {
        foreach ($this->filters as $filter) {
            if ($filter->filters($representation)) {
                return $filter->filter($properties, $this->version);
            }
        }

        return $properties;
    }
}
