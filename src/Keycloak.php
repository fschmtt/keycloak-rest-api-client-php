<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\Exception\VersionDetectionException;
use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\OAuth\GrantType;
use Fschmtt\Keycloak\OAuth\TokenStorage\InMemory;
use Fschmtt\Keycloak\OAuth\TokenStorageInterface;
use Fschmtt\Keycloak\Resource\AttackDetection;
use Fschmtt\Keycloak\Resource\Clients;
use Fschmtt\Keycloak\Resource\Groups;
use Fschmtt\Keycloak\Resource\Organizations;
use Fschmtt\Keycloak\Resource\Realms;
use Fschmtt\Keycloak\Resource\Resource;
use Fschmtt\Keycloak\Resource\Roles;
use Fschmtt\Keycloak\Resource\ServerInfo;
use Fschmtt\Keycloak\Resource\Users;
use Fschmtt\Keycloak\Serializer\Serializer;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;

/**
 * @codeCoverageIgnore
 */
class Keycloak
{
    private bool $versionResolved = false;
    private ?\Throwable $versionDetectionFailure = null;
    private Client $client;
    private Serializer $serializer;
    private CommandExecutor $commandExecutor;
    private QueryExecutor $queryExecutor;

    /**
     * @deprecated tag:v1.0.0 Use the Builder class to create Keycloak instances instead.
     * @see \Fschmtt\Keycloak\Builder
     */
    public function __construct(
        private readonly string $baseUrl,
        /** @deprecated tag:v1.0.0 Will be removed. */
        private readonly ?string $username = null,
        /** @deprecated tag:v1.0.0 Will be removed. */
        private readonly ?string $password = null,
        /** @deprecated tag:v1.0.0 Will be removed. */
        private readonly ?string $realm = null,
        private readonly TokenStorageInterface $tokenStorage = new InMemory(),
        ?ClientInterface $httpClient = new GuzzleClient(),
        private readonly ?GrantType $grantType = null,
        private ?string $version = null,
    ) {
        if ($this->username || $this->password || $this->realm) {
            trigger_deprecation(
                'fschmtt/keycloak-rest-api-client-php',
                'v0.39.0',
                'Passing a password grant type (username, password and realm) to the Keycloak instance is deprecated. Use Builder::withGrantType() instead.',
            );
        }

        $this->client = new Client($this, $httpClient, $this->tokenStorage);
        $this->serializer = new Serializer($this->version);
        $this->commandExecutor = new CommandExecutor($this->client, $this->serializer);
        $this->queryExecutor = new QueryExecutor($this->client, $this->serializer);
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @deprecated tag:v1.0.0 Use Keycloak::getGrantType() to access grant type details.
     * @see Keycloak::getGrantType()
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @deprecated tag:v1.0.0 Use Keycloak::getGrantType() to access grant type details.
     * @see Keycloak::getGrantType()
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getGrantType(): ?GrantType
    {
        return $this->grantType;
    }

    /**
     * @throws VersionDetectionException
     */
    public function getVersion(): string
    {
        $this->fetchVersion();

        if ($this->version === null) {
            throw new VersionDetectionException(
                'Could not determine the Keycloak version from GET /admin/serverinfo. Since Keycloak 26.4 '
                . 'that endpoint withholds systemInfo from insufficiently privileged accounts: 26.4 restricted '
                . 'it to administrators of the master realm, while 26.5 and later gate it on the manage-realm '
                . 'role in the account\'s own realm. Grant the account manage-realm, or pass the version '
                . 'explicitly via Builder::withVersion() to skip version detection.',
                previous: $this->versionDetectionFailure,
            );
        }

        return $this->version;
    }

    /**
     * @deprecated tag:v1.0.0
     */
    public function getRealm(): ?string
    {
        return $this->realm;
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

    public function organizations(): Organizations
    {
        $this->fetchVersion();

        return new Organizations($this->commandExecutor, $this->queryExecutor);
    }

    /**
     * @template T of Resource
     * @param class-string<T> $resource
     * @return T
     */
    public function resource(string $resource): Resource
    {
        $this->fetchVersion();

        return new $resource($this->commandExecutor, $this->queryExecutor);
    }

    private function fetchVersion(): void
    {
        if ($this->versionResolved || $this->version !== null) {
            return;
        }

        // Set before detecting so a failed detection is not retried on every subsequent accessor call
        $this->versionResolved = true;

        try {
            $this->version = $this->serverInfo()->get()->getSystemInfo()?->getVersion();
        } catch (\Throwable $e) {
            // A response carrying systemInfo without a version raises a TypeError, not a null return
            $this->versionDetectionFailure = $e;

            return;
        }

        if ($this->version === null) {
            return;
        }

        $this->serializer = new Serializer($this->version);
        $this->commandExecutor = new CommandExecutor($this->client, $this->serializer);
        $this->queryExecutor = new QueryExecutor($this->client, $this->serializer);
    }
}
