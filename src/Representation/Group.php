<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method array|null getAccess()
 * @method array|null getAttributes()
 * @method array|null getClientRoles()
 * @method string|null getId()
 * @method string|null getName()
 * @method string|null getPath()
 * @method array|null getRealmRoles()
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
    protected ?array $access;

    protected ?array $attributes;

    protected ?array $clientRoles;

    protected ?string $id;

    protected ?string $name;

    protected ?string $path;

    protected ?array $realmRoles;

    /**
     * @var Group[]|null
     */
    protected ?array $subGroups;

    public static function from(array $properties): static
    {
        foreach ($properties as $property => $value) {
            if ($property === 'subGroups') {
                foreach ($value as $group) {
                    $properties[$property][] = static::from($group);
                }
            }
        }

        return parent::from($properties);
    }
}
