<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class Scope extends Representation
{
    protected ?string $displayName;

    protected ?string $iconUri;

    protected ?string $id;

    protected ?string $name;

    /**
     * @var Policy[]|null
     */
    protected ?array $policies;

    /**
     * @var Resource[]|null
     */
    protected ?array $resources;

    public static function from(array $properties): static
    {
        foreach ($properties as $property => $value) {
            if ($property === 'policies') {
                $policies = [];

                foreach ($value as $policy) {
                    $policies[] = Policy::from($policy);
                }

                $properties[$property] = $policies;
            }

            if ($property === 'resources') {
                $resources = [];

                foreach ($value as $resource) {
                    $resources[] = Resource::from($resource);
                }

                $properties[$property] = $resources;
            }
        }

        return parent::from($properties);
    }
}
