<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\Representation\ServerInfo;
use GuzzleHttp\Client;

class Keycloak
{
    private string $baseUrl;

    private string $username;

    private string $password;

    private string $accessToken;

    private Client $http;

    public function __construct(string $baseUrl, string $username, string $password)
    {
        $this->baseUrl = $baseUrl;
        $this->username = $username;
        $this->password = $password;
        $this->accessToken = $this->fetchAccessToken();
        $this->http = new Client([
            'base_uri' => $this->baseUrl . '/auth/admin/',
            'defaults' => [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ]
            ]
        ]);
    }

    public function getServerInfo(): ServerInfo
    {
        return ServerInfo::fromJson((string) $this->http->request(
            'GET',
            'serverinfo',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ]
            ]
        )->getBody());
    }

    public function getRealms(): array
    {
        $realms = $this->http->request(
            'GET',
            'realms',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ]
            ]
        )->getBody();

        // TODO Use mapper
        return json_decode($realms->__toString(), true);
    }

    private function fetchAccessToken(): string
    {
        $response = (new Client())->request(
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
