<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class ProfileInfo extends Representation
{
    protected ?array $disabledFeatures;

    protected ?array $experimentalFeatures;

    protected ?string $name;

    protected ?array $previewFeatures;

    public function getDisabledFeatures(): ?array
    {
        return $this->disabledFeatures;
    }

    public function getExperimentalFeatures(): ?array
    {
        return $this->experimentalFeatures;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPreviewFeatures(): ?array
    {
        return $this->previewFeatures;
    }
}
