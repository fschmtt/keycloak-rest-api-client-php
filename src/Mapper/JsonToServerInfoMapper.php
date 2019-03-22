<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Mapper;

use Fschmtt\Keycloak\Representation\MemoryInfo;
use Fschmtt\Keycloak\Representation\PasswordPolicyType;
use Fschmtt\Keycloak\Representation\ProfileInfo;
use Fschmtt\Keycloak\Representation\ServerInfo;
use Fschmtt\Keycloak\Representation\SystemInfo;

class JsonToServerInfoMapper
{
    public function map(string $json): ServerInfo
    {
        $json = json_decode($json, true);

        var_dump($json);

        return new ServerInfo(
            $json['builtinProtocolMappers'] ?? null,
            $json['clientImporters'] ?? null,
            $json['clientInstallations'] ?? null,
            $json['componentTypes'] ?? null,
            $json['enums'] ?? null,
            $json['identityProviders'] ?? null,
            $json['memoryInfo'] ? $this->mapMemoryInfo($json['memoryInfo']) : null,
            $json['passwordPolicies'] ? $this->mapPasswordPolicies($json['passwordPolicies']) : null,
            $json['protocolMapperTypes'] ?? null,
            $json['profileInfo'] ? $this->mapProfileInfo($json['profileInfo']) : null,
            $json['providers'] ?? null,
            $json['socialProviders'] ?? null,
            $json['systemInfo'] ? $this->mapSystemInfo($json['systemInfo']) : null,
            $json['themes'] ?? null
        );
    }

    private function mapMemoryInfo(array $memoryInfo): MemoryInfo
    {
        return new MemoryInfo(
            (int) $memoryInfo['free'],
            $memoryInfo['freeFormated'],
            (int) $memoryInfo['total'],
            $memoryInfo['totalFormated'],
            (int) $memoryInfo['used'],
            $memoryInfo['usedFormated']
        );
    }

    private function mapProfileInfo(array $profileInfo): ProfileInfo
    {
        return new ProfileInfo(
            $profileInfo['disabledFeatures'],
            $profileInfo['experimentalFeatures'],
            $profileInfo['name'],
            $profileInfo['previewFeatures']
        );
    }

    private function mapSystemInfo(array $systemInfo): SystemInfo
    {
        return new SystemInfo(
            $systemInfo['fileEncoding'],
            $systemInfo['javaHome'],
            $systemInfo['javaRuntime'],
            $systemInfo['javaVendor'],
            $systemInfo['javaVersion'],
            $systemInfo['javaVm'],
            $systemInfo['javaVmVersion'],
            $systemInfo['osArchitecture'],
            $systemInfo['osName'],
            $systemInfo['osVersion'],
            $systemInfo['serverTime'],
            $systemInfo['uptime'],
            $systemInfo['uptimeMillis'],
            $systemInfo['userDir'],
            $systemInfo['userLocale'],
            $systemInfo['userName'],
            $systemInfo['userTimezone'],
            $systemInfo['version']
        );
    }

    private function mapPasswordPolicies(array $passwordPolicies): array
    {
        $policies = [];

        foreach ($passwordPolicies as $passwordPolicy) {
            $policies[] = new PasswordPolicyType(
                $passwordPolicy['configType'] ?? null,
                $passwordPolicy['defaultValue'] ?? null,
                $passwordPolicy['displayName'] ?? null,
                $passwordPolicy['id'] ?? null,
                isset($passwordPolicy['multipleSupported']) ? (bool) $passwordPolicy['multipleSupported'] : null
            );
        }

        return $policies;
    }
}
