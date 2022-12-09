<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\PropertyFilter;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\Resource\AttackDetection;
use Fschmtt\Keycloak\Resource\Clients;
use Fschmtt\Keycloak\Resource\Realms;
use Fschmtt\Keycloak\Resource\ServerInfo;
use Fschmtt\Keycloak\Serializer\Factory as SerializerFactory;

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
        private readonly string $password
    ) {
        $this->client = new Client($this);
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
