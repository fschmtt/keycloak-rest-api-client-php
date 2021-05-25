<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Mapper;

use Fschmtt\Keycloak\Json\JsonDecoder;
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

        return ServerInfo::from($properties);
    }
}
