<?php

namespace Fschmtt\Keycloak\Representation;

class PasswordPolicyType extends Representation
{
    protected ?string $configType;

    protected ?string $defaultValue;

    protected ?string $displayName;

    protected ?string $id;

    protected ?bool $multipleSupported;

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
