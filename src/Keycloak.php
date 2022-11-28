<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\PropertyFilter\PropertyFilter;
use Fschmtt\Keycloak\Resource\AttackDetection;
use Fschmtt\Keycloak\Resource\Realms;
use Fschmtt\Keycloak\Resource\ServerInfo;

class Keycloak
{
    private string $baseUrl;
    private string $username;
    private string $password;
    private string $version;
    private Client $httpClient;
    private PropertyFilter $propertyFilter;

    public function __construct(string $baseUrl, string $username, string $password, string $version)
    {
        $this->baseUrl = $baseUrl;
        $this->username = $username;
        $this->password = $password;
        $this->version = $version;
        $this->httpClient = new Client($this);
        $this->propertyFilter = new PropertyFilter($this->version);
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

    public function attackDetection(): AttackDetection
    {
        return new AttackDetection($this->httpClient, $this->propertyFilter);
    }

    public function serverInfo(): ServerInfo
    {
        return new ServerInfo($this->httpClient, $this->propertyFilter);
    }

    public function realms(): Realms
    {
        return new Realms($this->httpClient, $this->propertyFilter);
    }
}
