<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

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
    protected ?array $builtinProtocolMappers;

    protected ?array $clientImporters;

    protected ?array $clientInstallations;

    protected ?array $componentTypes;

    protected ?array $enums;

    protected ?array $identityProviders;

    protected ?MemoryInfo $memoryInfo;

    /**
     * @var PasswordPolicyType[]|null
     */
    protected ?array $passwordPolicies;

    protected ?array $protocolMapperTypes;

    protected ?ProfileInfo $profileInfo;

    protected ?array $providers;

    protected ?array $socialProviders;

    protected ?SystemInfo $systemInfo;

    protected ?array $themes;

    public static function from(array $properties): static
    {
        foreach ($properties as $property => $value) {
            if ($property === 'systemInfo') {
                $properties[$property] = SystemInfo::from($value);
            }

            if ($property === 'memoryInfo') {
                $properties[$property] = MemoryInfo::from($value);
            }

            if ($property === 'profileInfo') {
                $properties[$property] = ProfileInfo::from($value);
            }

            if ($property === 'passwordPolicies') {
                $passwordPolicies = [];

                foreach ($value as $passwordPolicy) {
                    $passwordPolicies[] = PasswordPolicyType::from($passwordPolicy);
                }

                $properties[$property] = $passwordPolicies;
            }
        }

        return parent::from($properties);
    }
}
