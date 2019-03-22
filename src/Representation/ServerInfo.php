<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class ServerInfo
{
    /**
     * @var array
     */
    private $builtinProtocolMappers;

    /**
     * @var array
     */
    private $clientImporters;

    /**
     * @var array
     */
    private $clientInstallations;

    /**
     * @var array
     */
    private $componentTypes;

    /**
     * @var array
     */
    private $enums;

    /**
     * @var array
     */
    private $identityProviders;

    /**
     * @var MemoryInfo
     */
    private $memoryInfo;

    /**
     * @var PasswordPolicyType[]
     */
    private $passwordPolicies;

    /**
     * @var array
     */
    private $protocolMapperTypes;

    /**
     * @var ProfileInfo
     */
    private $profileInfo;

    /**
     * @var array
     */
    private $providers;

    /**
     * @var array
     */
    private $socialProviders;

    /**
     * @var SystemInfo
     */
    private $systemInfo;

    /**
     * @var array
     */
    private $themes;

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

    public function getBuiltinProtocolMappers(): array
    {
        return $this->builtinProtocolMappers;
    }

    public function getClientImporters()
    {
        return $this->clientImporters;
    }

    public function getClientInstallations()
    {
        return $this->clientInstallations;
    }

    public function getComponentTypes()
    {
        return $this->componentTypes;
    }

    public function getEnums()
    {
        return $this->enums;
    }

    public function getIdentityProviders()
    {
        return $this->identityProviders;
    }

    public function getMemoryInfo(): MemoryInfo
    {
        return $this->memoryInfo;
    }

    public function getPasswordPolicies()
    {
        return $this->passwordPolicies;
    }

    public function getProtocolMapperTypes()
    {
        return $this->protocolMapperTypes;
    }

    public function getProfileInfo(): ProfileInfo
    {
        return $this->profileInfo;
    }

    public function getProviders()
    {
        return $this->providers;
    }

    public function getSocialProviders()
    {
        return $this->socialProviders;
    }

    public function getSystemInfo(): SystemInfo
    {
        return $this->systemInfo;
    }

    public function getThemes()
    {
        return $this->themes;
    }
}
