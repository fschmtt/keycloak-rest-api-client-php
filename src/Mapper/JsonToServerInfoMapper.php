<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Mapper;

use Fschmtt\Keycloak\JsonDecoder;
use Fschmtt\Keycloak\Representation\MemoryInfo;
use Fschmtt\Keycloak\Representation\PasswordPolicyType;
use Fschmtt\Keycloak\Representation\ProfileInfo;
use Fschmtt\Keycloak\Representation\ServerInfo;
use Fschmtt\Keycloak\Representation\SystemInfo;

class JsonToServerInfoMapper
{
    private JsonDecoder $jsonDecoder;

    public function __construct(JsonDecoder $jsonDecoder)
    {
        $this->jsonDecoder = $jsonDecoder;
    }

    public function map(string $json): ServerInfo
    {
        $properties = $this->jsonDecoder->decode($json);

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

        return new ServerInfo($properties);
    }
}
