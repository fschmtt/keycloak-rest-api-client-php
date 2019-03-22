<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class UserFederationMapper
{
    /**
     * @var array|null
     */
    private $config;

    /**
     * @var string|null
     */
    private $federationMapperType;

    /**
     * @var string|null
     */
    private $federationProviderDisplayName;

    /**
     * @var string|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @param array|null $config
     * @param string|null $federationMapperType
     * @param string|null $federationProviderDisplayName
     * @param string|null $id
     * @param string|null $name
     */
    public function __construct(
        ?array $config,
        ?string $federationMapperType,
        ?string $federationProviderDisplayName,
        ?string $id,
        ?string $name
    ) {
        $this->config = $config;
        $this->federationMapperType = $federationMapperType;
        $this->federationProviderDisplayName = $federationProviderDisplayName;
        $this->id = $id;
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
    public function getFederationMapperType(): ?string
    {
        return $this->federationMapperType;
    }

    /**
     * @return string|null
     */
    public function getFederationProviderDisplayName(): ?string
    {
        return $this->federationProviderDisplayName;
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
