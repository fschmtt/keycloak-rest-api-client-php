<?php

namespace Fschmtt\Keycloak\Representation;

class PasswordPolicyType
{
    /**
     * @var ?string
     */
    private $configType;

    /**
     * @var ?string
     */
    private $defaultValue;

    /**
     * @var ?string
     */
    private $displayName;

    /**
     * @var ?string
     */
    private $id;

    /**
     * @var ?bool
     */
    private $multipleSupported;

    public function __construct(
        ?string $configType,
        ?string $defaultValue,
        ?string $displayName,
        ?string $id,
        ?bool $multipleSupported
    ) {
        $this->configType = $configType;
        $this->defaultValue = $defaultValue;
        $this->displayName = $displayName;
        $this->id = $id;
        $this->multipleSupported = $multipleSupported;
    }

    public function getConfigType(): ?string
    {
        return $this->configType;
    }

    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMultipleSupported(): ?bool
    {
        return $this->multipleSupported;
    }
}
