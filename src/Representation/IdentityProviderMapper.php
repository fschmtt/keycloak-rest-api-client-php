<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class IdentityProviderMapper
{
    /**
     * @var array|null
     */
    private $config;

    /**
     * @var string|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $identityProviderAlias;

    /**
     * @var string|null
     */
    private $identityProviderMapper;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @param array|null $config
     * @param string|null $id
     * @param string|null $identityProviderAlias
     * @param string|null $identityProviderMapper
     * @param string|null $name
     */
    public function __construct(
        ?array $config,
        ?string $id,
        ?string $identityProviderAlias,
        ?string $identityProviderMapper,
        ?string $name
    ) {
        $this->config = $config;
        $this->id = $id;
        $this->identityProviderAlias = $identityProviderAlias;
        $this->identityProviderMapper = $identityProviderMapper;
        $this->name = $name;
    }

    /**
     * @return array|null
     */
    public function getConfig(): ?array
    {
        return $this->config;
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
    public function getIdentityProviderAlias(): ?string
    {
        return $this->identityProviderAlias;
    }

    /**
     * @return string|null
     */
    public function getIdentityProviderMapper(): ?string
    {
        return $this->identityProviderMapper;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
