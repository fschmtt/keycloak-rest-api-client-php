<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @codeCoverageIgnore
 */
class RequiredActionProvider extends Representation
{
    /**
     * @var string|null
     */
    private $alias;

    /**
     * @var array|null
     */
    private $config;

    /**
     * @var bool|null
     */
    private $defaultAction;

    /**
     * @var bool|null
     */
    private $enabled;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var bool|null
     */
    private $priority;

    /**
     * @var string|null
     */
    private $providerId;

    /**
     * @param string|null $alias
     * @param array|null $config
     * @param bool|null $defaultAction
     * @param bool|null $enabled
     * @param string|null $name
     * @param bool|null $priority
     * @param string|null $providerId
     */
    public function __construct(
        ?string $alias,
        ?array $config,
        ?bool $defaultAction,
        ?bool $enabled,
        ?string $name,
        ?bool $priority,
        ?string $providerId
    ) {
        $this->alias = $alias;
        $this->config = $config;
        $this->defaultAction = $defaultAction;
        $this->enabled = $enabled;
        $this->name = $name;
        $this->priority = $priority;
        $this->providerId = $providerId;
    }

    /**
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @return array|null
     */
    public function getConfig(): ?array
    {
        return $this->config;
    }

    /**
     * @return bool|null
     */
    public function getDefaultAction(): ?bool
    {
        return $this->defaultAction;
    }

    /**
     * @return bool|null
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return bool|null
     */
    public function getPriority(): ?bool
    {
        return $this->priority;
    }

    /**
     * @return string|null
     */
    public function getProviderId(): ?string
    {
        return $this->providerId;
    }
}
