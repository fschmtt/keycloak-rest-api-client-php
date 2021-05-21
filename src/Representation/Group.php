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
 * @method array|null withAccess(?array $access)
 * @method array|null withAttributes(?array $attributes)
 * @method array|null withClientRoles(?array $clientRoles)
 * @method string|null withId(?string $id)
 * @method string|null withName(?string $name)
 * @method string|null withPath(?string $path)
 * @method array|null withRealmRoles(?array $realmRoles)
 * @method Group[]|null withSubGroups(?array $subGroups)
 */
class Group extends Representation
{
    private ?array $access;

    private ?array $attributes;

    private ?array $clientRoles;

    private ?string $id;

    private ?string $name;

    private ?string $path;

    private ?array $realmRoles;

    /**
     * @var Group[]|null
     */
    private ?array $subGroups;

    public function __construct(array $properties)
    {
        foreach ($properties as $property => $value) {
            if ($property === 'subGroups') {
                $properties[$property] = new Group($properties);
            }
        }

        parent::__construct($properties);
    }
}
