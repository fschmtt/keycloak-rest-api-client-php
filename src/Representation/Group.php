<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class Group
{
    /**
     * @var array|null
     */
    private $access;

    /**
     * @var array|null
     */
    private $attributes;

    /**
     * @var array|null
     */
    private $clientRoles;

    /**
     * @var string|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $path;

    /**
     * @var string[]|null
     */
    private $realmRoles;

    /**
     * @var Group[]|null
     */
    private $subGroups;

    /**
     * @param array|null $access
     * @param array|null $attributes
     * @param array|null $clientRoles
     * @param string|null $id
     * @param string|null $name
     * @param string|null $path
     * @param string[]|null $realmRoles
     * @param Group[]|null $subGroups
     */
    public function __construct(
        ?array $access,
        ?array $attributes,
        ?array $clientRoles,
        ?string $id,
        ?string $name,
        ?string $path,
        ?array $realmRoles,
        ?array $subGroups
    ) {
        $this->access = $access;
        $this->attributes = $attributes;
        $this->clientRoles = $clientRoles;
        $this->id = $id;
        $this->name = $name;
        $this->path = $path;
        $this->realmRoles = $realmRoles;
        $this->subGroups = $subGroups;
    }

    /**
     * @return array|null
     */
    public function getAccess(): ?array
    {
        return $this->access;
    }

    /**
     * @return array|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @return array|null
     */
    public function getClientRoles(): ?array
    {
        return $this->clientRoles;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return string[]|null
     */
    public function getRealmRoles(): ?array
    {
        return $this->realmRoles;
    }

    /**
     * @return Group[]|null
     */
    public function getSubGroups(): ?array
    {
        return $this->subGroups;
    }
}
