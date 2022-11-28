<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @codeCoverageIgnore
 */
class ClientScope extends Representation
{
    /**
     * @var array|null
     */
    private $attributes;

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
     * @var string|null
     */
    private $protocol;

    /**
     * @var ProtocolMapper[]|null
     */
    private $protocolMappers;

    /**
     * @param array|null $attributes
     * @param string|null $description
     * @param string|null $id
     * @param string|null $name
     * @param string|null $protocol
     * @param ProtocolMapper[]|null $protocolMappers
     */
    public function __construct(
        ?array $attributes,
        ?string $description,
        ?string $id,
        ?string $name,
        ?string $protocol,
        ?array $protocolMappers
    ) {
        $this->attributes = $attributes;
        $this->description = $description;
        $this->id = $id;
        $this->name = $name;
        $this->protocol = $protocol;
        $this->protocolMappers = $protocolMappers;
    }

    /**
     * @return array|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
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

    /**
     * @return string|null
     */
    public function getProtocol(): ?string
    {
        return $this->protocol;
    }

    /**
     * @return ProtocolMapper[]|null
     */
    public function getProtocolMappers(): ?array
    {
        return $this->protocolMappers;
    }
}
