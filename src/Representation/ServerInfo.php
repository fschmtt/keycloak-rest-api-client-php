<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method array|null getBuiltinProtocolMappers(?array $builtinProtocolMappers)
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

    public function __construct(array $properties)
    {
        foreach ($properties as $property => $value) {
            if ($property === 'systemInfo') {
                $properties[$property] = new SystemInfo($value);
            }

            if ($property === 'memoryInfo') {
                $properties[$property] = new MemoryInfo($value);
            }

            if ($property === 'profileInfo') {
                $properties[$property] = new ProfileInfo($value);
            }

            if ($property === 'passwordPolicies') {
                $passwordPolicies = [];

                foreach ($value as $passwordPolicy) {
                    $passwordPolicies[] = new PasswordPolicyType($passwordPolicy);
                }

                $properties[$property] = $passwordPolicies;
            }
        }

        parent::__construct($properties);
    }
}
