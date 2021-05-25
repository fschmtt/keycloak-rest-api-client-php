<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Resource\Realms;
use Fschmtt\Keycloak\Resource\ServerInfo;

class Keycloak
{
    private string $baseUrl;
    private string $username;
    private string $password;
    private Http\Client $httpClient;

    public function __construct(string $baseUrl, string $username, string $password)
    {
        $this->baseUrl = $baseUrl;
        $this->username = $username;
        $this->password = $password;
        $this->httpClient = new Client($this);
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function serverInfo(): ServerInfo
    {
        return new ServerInfo($this->httpClient);
    }

    public function realms(): Realms
    {
        return new Realms($this->httpClient);
    }
}
