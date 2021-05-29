<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string[]|null getAccess()
 * @method string[]|null getAttributes()
 * @method string[]|null getClientRoles()
 * @method string|null getId()
 * @method string|null getName()
 * @method string|null getPath()
 * @method string[]|null getRealmRoles()
 * @method Group[]|null getSubGroups()
 * @method self withAccess(?array $access)
 * @method self withAttributes(?array $attributes)
 * @method self withClientRoles(?array $clientRoles)
 * @method self withId(?string $id)
 * @method self withName(?string $name)
 * @method self withPath(?string $path)
 * @method self withRealmRoles(?array $realmRoles)
 * @method self withSubGroups(?array $subGroups)
 */
class Group extends Representation
{
    public function __construct(
        protected ?array $access = null,
        protected ?array $attributes = null,
        protected ?array $clientRoles = null,
        protected ?string $id = null,
        protected ?string $name = null,
        protected ?string $path = null,
        protected ?array $realmRoles = null,
        protected ?array $subGroups = null,
    ) {
        parent::__construct(
            $access,
            $attributes,
            $clientRoles,
            $id,
            $name,
            $path,
            $realmRoles,
            $subGroups,
        );
    }

    public static function from(array $properties): static
    {
        foreach ($properties as $property => $value) {
            if ($property === 'subGroups') {
                $subGroups = [];

                foreach ($value as $group) {
                    $subGroups[] = static::from($group);
                }

                $properties[$property] = $subGroups;
            }
        }

        return parent::from($properties);
    }

    public function with(string $property, mixed $value): static
    {
        if ($property === 'subGroups') {
            $subGroups = [];

            foreach ($value as $group) {
                $subGroups[] = static::from($group);
            }

            $value = $subGroups;
        }

        return parent::with($property, $value);
    }
}
