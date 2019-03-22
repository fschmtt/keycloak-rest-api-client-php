<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class ServerInfo
{
    /**
     * @var array|null
     */
    private $builtinProtocolMappers;

    /**
     * @var array|null
     */
    private $clientImporters;

    /**
     * @var array|null
     */
    private $clientInstallations;

    /**
     * @var array|null
     */
    private $componentTypes;

    /**
     * @var array|null
     */
    private $enums;

    /**
     * @var array|null
     */
    private $identityProviders;

    /**
     * @var MemoryInfo|null
     */
    private $memoryInfo;

    /**
     * @var PasswordPolicyType[]|null
     */
    private $passwordPolicies;

    /**
     * @var array|null
     */
    private $protocolMapperTypes;

    /**
     * @var ProfileInfo|null
     */
    private $profileInfo;

    /**
     * @var array|null
     */
    private $providers;

    /**
     * @var array|null
     */
    private $socialProviders;

    /**
     * @var SystemInfo|null
     */
    private $systemInfo;

    /**
     * @var array|null
     */
    private $themes;

    /**
     * @param array|null $builtinProtocolMappers
     * @param array|null $clientImporters
     * @param array|null $clientInstallations
     * @param array|null $componentTypes
     * @param array|null $enums
     * @param array|null $identityProviders
     * @param MemoryInfo|null $memoryInfo
     * @param array|null $passwordPolicies
     * @param array|null $protocolMapperTypes
     * @param ProfileInfo|null $profileInfo
     * @param array|null $providers
     * @param array|null $socialProviders
     * @param SystemInfo|null $systemInfo
     * @param array|null $themes
     */
    public function __construct(
        ?array $builtinProtocolMappers,
        ?array $clientImporters,
        ?array $clientInstallations,
        ?array $componentTypes,
        ?array $enums,
        ?array $identityProviders,
        ?MemoryInfo $memoryInfo,
        ?array $passwordPolicies,
        ?array $protocolMapperTypes,
        ?ProfileInfo $profileInfo,
        ?array $providers,
        ?array $socialProviders,
        ?SystemInfo $systemInfo,
        ?array $themes
    ) {
        $this->builtinProtocolMappers = $builtinProtocolMappers;
        $this->clientImporters = $clientImporters;
        $this->clientInstallations = $clientInstallations;
        $this->componentTypes = $componentTypes;
        $this->enums = $enums;
        $this->identityProviders = $identityProviders;
        $this->memoryInfo = $memoryInfo;
        $this->passwordPolicies = $passwordPolicies;
        $this->protocolMapperTypes = $protocolMapperTypes;
        $this->profileInfo = $profileInfo;
        $this->providers = $providers;
        $this->socialProviders = $socialProviders;
        $this->systemInfo = $systemInfo;
        $this->themes = $themes;
    }

    /**
     * @return array|null
     */
    public function getBuiltinProtocolMappers(): ?array
    {
        return $this->builtinProtocolMappers;
    }

    /**
     * @return array|null
     */
    public function getClientImporters(): ?array
    {
        return $this->clientImporters;
    }

    /**
     * @return array|null
     */
    public function getClientInstallations(): ?array
    {
        return $this->clientInstallations;
    }

    /**
     * @return array|null
     */
    public function getComponentTypes(): ?array
    {
        return $this->componentTypes;
    }

    /**
     * @return array|null
     */
    public function getEnums(): ?array
    {
        return $this->enums;
    }

    /**
     * @return array|null
     */
    public function getIdentityProviders(): ?array
    {
        return $this->identityProviders;
    }

    /**
     * @return MemoryInfo|null
     */
    public function getMemoryInfo(): ?MemoryInfo
    {
        return $this->memoryInfo;
    }

    /**
     * @return PasswordPolicyType[]|null
     */
    public function getPasswordPolicies(): ?array
    {
        return $this->passwordPolicies;
    }

    /**
     * @return array|null
     */
    public function getProtocolMapperTypes(): ?array
    {
        return $this->protocolMapperTypes;
    }

    /**
     * @return ProfileInfo|null
     */
    public function getProfileInfo(): ?ProfileInfo
    {
        return $this->profileInfo;
    }

    /**
     * @return array|null
     */
    public function getProviders(): ?array
    {
        return $this->providers;
    }

    /**
     * @return array|null
     */
    public function getSocialProviders(): ?array
    {
        return $this->socialProviders;
    }

    /**
     * @return SystemInfo|null
     */
    public function getSystemInfo(): ?SystemInfo
    {
        return $this->systemInfo;
    }

    /**
     * @return array|null
     */
    public function getThemes(): ?array
    {
        return $this->themes;
    }
}
