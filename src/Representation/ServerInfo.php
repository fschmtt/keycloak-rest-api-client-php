<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Attribute\Since;
use Fschmtt\Keycloak\Collection\PasswordPolicyTypeCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method array|null getBuiltinProtocolMappers()
 * @method array|null getClientImporters()
 * @method array|null getClientInstallations()
 * @method array|null getComponentTypes()
 * @method CryptoInfo|null getCryptoInfo()
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
 */
class ServerInfo extends Representation
{
    public function __construct(
        protected readonly ?Map $builtinProtocolMappers = null,
        protected readonly ?Map $clientImporters = null,
        protected readonly ?Map $clientInstallations = null,
        protected readonly ?Map $componentTypes = null,
        #[Since('20.0.0')]
        protected readonly ?CryptoInfo $cryptoInfo = null,
        protected readonly ?Map $enums = null,
        protected readonly ?Map $identityProviders = null,
        protected readonly ?MemoryInfo $memoryInfo = null,
        protected readonly ?PasswordPolicyTypeCollection $passwordPolicies = null,
        protected readonly ?ProfileInfo $profileInfo = null,
        protected readonly ?Map $protocolMapperTypes = null,
        protected readonly ?Map $providers = null,
        protected readonly ?Map $socialProviders = null,
        protected readonly ?SystemInfo $systemInfo = null,
        protected readonly ?Map $themes = null,
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
