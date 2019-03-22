<?php declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\Representation\MemoryInfo;
use Fschmtt\Keycloak\Representation\ProfileInfo;
use Fschmtt\Keycloak\Representation\ServerInfo;
use Fschmtt\Keycloak\Representation\SystemInfo;

class Keycloak
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $accessToken;

    public function __construct(string $baseUrl, string $username, string $password)
    {
        $this->baseUrl = $baseUrl;
        $this->username = $username;
        $this->password = $password;
        $this->accessToken = $this->fetchAccessToken();
        $this->http = new \GuzzleHttp\Client([
            'base_uri' => $this->baseUrl . '/auth/',
            'defaults' => [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ]
            ]
        ]);
    }

    public function getServerInfo(): ServerInfo
    {
        $serverInfo = json_decode($this->http->request(
            'GET',
            'admin/serverinfo',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ]
            ]
        )->getBody()->__toString(), true);

        return new ServerInfo(
            $serverInfo['builtinProtocolMappers'],
            $serverInfo['clientImporters'] ?? null,
            $serverInfo['clientInstallations'],
            $serverInfo['componentTypes'],
            $serverInfo['enums'],
            $serverInfo['identityProviders'],
            new MemoryInfo(
                (int) $serverInfo['memoryInfo']['free'],
                $serverInfo['memoryInfo']['freeFormated'],
                (int) $serverInfo['memoryInfo']['total'],
                $serverInfo['memoryInfo']['totalFormated'],
                (int) $serverInfo['memoryInfo']['used'],
                $serverInfo['memoryInfo']['usedFormated']
            ),
            $serverInfo['passwordPolicies'],
            $serverInfo['protocolMapperTypes'],
            new ProfileInfo(
                $serverInfo['profileInfo']['disabledFeatures'],
                $serverInfo['profileInfo']['experimentalFeatures'],
                $serverInfo['profileInfo']['name'],
                $serverInfo['profileInfo']['previewFeatures']
            ),
            $serverInfo['providers'],
            $serverInfo['socialProviders'],
            new SystemInfo(
                $serverInfo['systemInfo']['fileEncoding'],
                $serverInfo['systemInfo']['javaHome'],
                $serverInfo['systemInfo']['javaRuntime'],
                $serverInfo['systemInfo']['javaVendor'],
                $serverInfo['systemInfo']['javaVersion'],
                $serverInfo['systemInfo']['javaVm'],
                $serverInfo['systemInfo']['javaVmVersion'],
                $serverInfo['systemInfo']['osArchitecture'],
                $serverInfo['systemInfo']['osName'],
                $serverInfo['systemInfo']['osVersion'],
                $serverInfo['systemInfo']['serverTime'],
                $serverInfo['systemInfo']['uptime'],
                $serverInfo['systemInfo']['uptimeMillis'],
                $serverInfo['systemInfo']['userDir'],
                $serverInfo['systemInfo']['userLocale'],
                $serverInfo['systemInfo']['userName'],
                $serverInfo['systemInfo']['userTimezone'],
                $serverInfo['systemInfo']['version']
            ),
            $serverInfo['themes']
        );
    }

    private function fetchAccessToken(): string
    {
        $response = (new \GuzzleHttp\Client())->request(
            'POST',
            $this->baseUrl . '/auth/realms/master/protocol/openid-connect/token',
            [
                'form_params' => [
                    'username' => $this->username,
                    'password' => $this->password,
                    'client_id' => 'admin-cli',
                    'grant_type' => 'password',
                ]
            ]
        );

        return (string) json_decode($response->getBody()->__toString())->access_token;
    }
}
