<?php declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\Mapper\JsonToServerInfoMapper;
use Fschmtt\Keycloak\Representation\ServerInfo;

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
        $serverInfo = $this->http->request(
            'GET',
            'admin/serverinfo',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ]
            ]
        )->getBody();

        return (new JsonToServerInfoMapper())->map((string) $serverInfo);
    }

    public function getRealms(): array
    {
        $realms = $this->http->request(
            'GET',
            'admin/realms',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ]
            ]
        )->getBody();

        return json_decode($realms->__toString(), true);
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
