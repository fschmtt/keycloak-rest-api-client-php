<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class ProfileInfo
{
    /**
     * @var array|null
     */
    private $disabledFeatures;

    /**
     * @var array|null
     */
    private $experimentalFeatures;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var array|null
     */
    private $previewFeatures;

    public function __construct(
        ?array $disabledFeatures,
        ?array $experimentalFeatures,
        ?string $name,
        ?array $previewFeatures
    ) {
        $this->disabledFeatures = $disabledFeatures;
        $this->experimentalFeatures = $experimentalFeatures;
        $this->name = $name;
        $this->previewFeatures = $previewFeatures;
    }

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
