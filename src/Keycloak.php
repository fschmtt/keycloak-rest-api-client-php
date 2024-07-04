<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\PropertyFilter;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\OAuth\TokenStorage\InMemory;
use Fschmtt\Keycloak\OAuth\TokenStorageInterface;
use Fschmtt\Keycloak\Resource\AttackDetection;
use Fschmtt\Keycloak\Resource\Clients;
use Fschmtt\Keycloak\Resource\Groups;
use Fschmtt\Keycloak\Resource\Realms;
use Fschmtt\Keycloak\Resource\Resource;
use Fschmtt\Keycloak\Resource\Roles;
use Fschmtt\Keycloak\Resource\ServerInfo;
use Fschmtt\Keycloak\Resource\Users;
use Fschmtt\Keycloak\Serializer\Factory as SerializerFactory;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;

class Keycloak
{
    private ?string $version = null;
    private Client $client;
    private PropertyFilter $propertyFilter;
    private CommandExecutor $commandExecutor;
    private QueryExecutor $queryExecutor;

    public function __construct(
        private readonly string $baseUrl,
        private readonly string $username,
        private readonly string $password,
        private readonly TokenStorageInterface $tokenStorage = new InMemory(),
        ?ClientInterface $guzzleClient = new GuzzleClient(),
    ) {
        $this->client = new Client($this, $guzzleClient, $this->tokenStorage);
        $this->propertyFilter = new PropertyFilter($this->version);
        $this->commandExecutor = new CommandExecutor($this->client, $this->propertyFilter);
        $this->queryExecutor = new QueryExecutor($this->client, (new SerializerFactory())->create());
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

    public function getVersion(): string
    {
        $this->fetchVersion();

        return $this->version;
    }

    public function attackDetection(): AttackDetection
    {
        $this->fetchVersion();

        return new AttackDetection($this->commandExecutor, $this->queryExecutor);
    }

    public function serverInfo(): ServerInfo
    {
        return new ServerInfo($this->commandExecutor, $this->queryExecutor);
    }

    public function realms(): Realms
    {
        $this->fetchVersion();

        return new Realms($this->commandExecutor, $this->queryExecutor);
    }

    public function clients(): Clients
    {
        $this->fetchVersion();

        return new Clients($this->commandExecutor, $this->queryExecutor);
    }

    public function users(): Users
    {
        $this->fetchVersion();

        return new Users($this->commandExecutor, $this->queryExecutor);
    }

    public function groups(): Groups
    {
        $this->fetchVersion();

        return new Groups($this->commandExecutor, $this->queryExecutor);
    }

    public function roles(): Roles
    {
        $this->fetchVersion();

        return new Roles($this->commandExecutor, $this->queryExecutor);
    }

    /**
     * @param class-string<Resource> $resource
     * @return Resource
     */
    public function resource(string $resource): Resource
    {
        $this->fetchVersion();

        return new $resource($this->commandExecutor, $this->queryExecutor);
    }

    private function fetchVersion(): void
    {
        if ($this->version) {
            return;
        }

        $this->version = $this->serverInfo()->get()->getSystemInfo()->getVersion();
        $this->propertyFilter = new PropertyFilter($this->version);
        $this->commandExecutor = new CommandExecutor($this->client, $this->propertyFilter);
    }
}
