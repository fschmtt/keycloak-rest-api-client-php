<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class AuthenticatorConfig
{
    /**
     * @var string
     */
    private $alias;

    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    private $id;

    public function __construct(
        ?string $alias,
        ?array $config,
        ?string $id
    ) {
        $this->alias = $alias;
        $this->config = $config;
        $this->id = $id;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
