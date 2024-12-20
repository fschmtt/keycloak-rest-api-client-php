<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Attribute\Since;
use Fschmtt\Keycloak\Collection\FeatureCollection;
use Fschmtt\Keycloak\Collection\PasswordPolicyTypeCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getBuiltinProtocolMappers()
 * @method Map|null getClientImporters()
 * @method Map|null getClientInstallations()
 * @method Map|null getComponentTypes()
 * @method CryptoInfo|null getCryptoInfo()
 * @method Map|null getEnums()
 * @method FeatureCollection|null getFeatures()
 * @method Map|null getIdentityProviders()
 * @method MemoryInfo|null getMemoryInfo()
 * @method PasswordPolicyType[]|null getPasswordPolicies()
 * @method Map|null getProtocolMapperTypes()
 * @method ProfileInfo|null getProfileInfo()
 * @method Map|null getProviders()
 * @method Map|null getSocialProviders()
 * @method SystemInfo|null getSystemInfo()
 * @method Map|null getThemes()
 *
 * @codeCoverageIgnore
 */
class ServerInfo extends Representation
{
    public function __construct(
        protected ?Map $builtinProtocolMappers = null,
        protected ?Map $clientImporters = null,
        protected ?Map $clientInstallations = null,
        protected ?Map $componentTypes = null,
        #[Since('20.0.0')]
        protected ?CryptoInfo $cryptoInfo = null,
        protected ?Map $enums = null,
        #[Since('22.0.4')]
        protected ?FeatureCollection $features = null,
        protected ?Map $identityProviders = null,
        protected ?MemoryInfo $memoryInfo = null,
        protected ?PasswordPolicyTypeCollection $passwordPolicies = null,
        protected ?ProfileInfo $profileInfo = null,
        protected ?Map $protocolMapperTypes = null,
        protected ?Map $providers = null,
        protected ?Map $socialProviders = null,
        protected ?SystemInfo $systemInfo = null,
        protected ?Map $themes = null,
    ) {}
}
