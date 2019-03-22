<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class Role
{
    /**
     * @var array|null
     */
    private $attributes;

    /**
     * @var bool|null
     */
    private $clientRole;

    /**
     * @var bool|null
     */
    private $composite;

    /**
     * @var RoleComposites|null
     * TODO
     */
    private $composites;

    /**
     * @var string|null
     */
    private $containerId;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @param array|null $attributes
     * @param bool|null $clientRole
     * @param bool|null $composite
     * @param RoleComposites|null $composites
     * @param string|null $containerId
     * @param string|null $description
     * @param string|null $id
     * @param string|null $name
     */
    public function __construct(
        ?array $attributes,
        ?bool $clientRole,
        ?bool $composite,
        ?RoleComposites $composites,
        ?string $containerId,
        ?string $description,
        ?string $id,
        ?string $name
    ) {
        $this->attributes = $attributes;
        $this->clientRole = $clientRole;
        $this->composite = $composite;
        $this->composites = $composites;
        $this->containerId = $containerId;
        $this->description = $description;
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return array|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @return bool|null
     */
    public function getClientRole(): ?bool
    {
        return $this->clientRole;
    }

    /**
     * @return bool|null
     */
    public function getComposite(): ?bool
    {
        return $this->composite;
    }

    /**
     * @return RoleComposites|null
     */
    public function getComposites(): ?RoleComposites
    {
        return $this->composites;
    }

    /**
     * @return string|null
     */
    public function getContainerId(): ?string
    {
        return $this->containerId;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
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
}
