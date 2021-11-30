<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\PasswordPolicyTypeCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method array|null getBuiltinProtocolMappers()
 * @method array|null getClientImporters()
 * @method array|null getClientInstallations()
 * @method array|null getComponentTypes()
 * @method array|null getEnums()
 * @method array|null getIdentityProviders()
 * @method MemoryInfo|null getMemoryInfo()
 * @method PasswordPolicyType[]|null getPasswordPolicies()
 * @method array|null getProtocolMapperTypes()
 * @method ProfileInfo|null getProfileInfo()
 * @method array|null getProviders()
 * @method array|null getSocialProviders()
 * @method SystemInfo|null getSystemInfo()
 * @method array|null getThemes()
 * @method self withBuiltinProtocolMappers(?array $builtinProtocolMappers)
 * @method self withClientImporters(?array $clientImporters)
 * @method self withClientInstallations(?array $clientInstallations)
 * @method self withComponentTypes(?array $componentTypes)
 * @method self withEnums(?array $enums)
 * @method self withIdentityProviders(?array $identityProviders)
 * @method self withMemoryInfo(?MemoryInfo $memoryInfo)
 * @method self withPasswordPolicies(?array $passwordPolicies)
 * @method self withProtocolMapperTypes(?MemoryInfo $protocolMapperTypes)
 * @method self withProfileInfo(?ProfileInfo $profileInfo)
 * @method self withProviders(?array $providers)
 * @method self withSocialProviders(?array $socialProviders)
 * @method self withSystemInfo(?SystemInfo $systemInfo)
 * @method self withThemes(?array $themes)
 */
class ServerInfo extends Representation
{
    public function __construct(
        protected ?Map $builtinProtocolMappers = null,
        protected ?Map $clientImporters = null,
        protected ?Map $clientInstallations = null,
        protected ?Map $componentTypes = null,
        protected ?Map $enums = null,
        protected ?Map $identityProviders = null,
        protected ?MemoryInfo $memoryInfo = null,
        protected ?PasswordPolicyTypeCollection $passwordPolicies = null,
        protected ?ProfileInfo $profileInfo = null,
        protected ?Map $protocolMapperTypes = null,
        protected ?Map $providers = null,
        protected ?Map $socialProviders = null,
        protected ?SystemInfo $systemInfo = null,
        protected ?Map $themes = null,
    ) {
        parent::__construct(
            $builtinProtocolMappers,
            $clientImporters,
            $clientImporters,
            $componentTypes,
            $enums,
            $identityProviders,
            $memoryInfo,
            $passwordPolicies,
            $profileInfo,
            $protocolMapperTypes,
            $providers,
            $socialProviders,
            $systemInfo,
            $themes,
        );
    }
}
