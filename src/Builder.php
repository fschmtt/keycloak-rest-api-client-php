<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\Exception\BuilderException;
use Fschmtt\Keycloak\OAuth\GrantType;
use Fschmtt\Keycloak\OAuth\TokenStorage\InMemory as InMemoryTokenStorage;
use Fschmtt\Keycloak\OAuth\TokenStorageInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;

class Builder
{
    private ?string $baseUrl = null;

    private ?GrantType $grantType = null;

    private TokenStorageInterface $tokenStorage;

    private ClientInterface $httpClient;

    private ?string $version = null;

    public function __construct()
    {
        $this->tokenStorage = new InMemoryTokenStorage();
        $this->httpClient = new GuzzleClient();
    }

    public function withBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    public function withGrantType(GrantType $grantType): self
    {
        $this->grantType = $grantType;

        return $this;
    }

    public function withTokenStorage(TokenStorageInterface $tokenStorage): self
    {
        $this->tokenStorage = $tokenStorage;

        return $this;
    }

    public function withHttpClient(ClientInterface $client): self
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * Pins the Keycloak version (x.y.z, e.g. 26.7.2) so it is not detected at runtime via API (GET /admin/serverinfo).
     *
     * @throws BuilderException
     */
    public function withVersion(string $version): self
    {
        if (preg_match('/^\d+\.\d+\.\d+$/D', $version) !== 1) {
            throw new BuilderException(sprintf('Version must follow the pattern x.y.z (e.g. 26.7.2), got "%s"', $version));
        }

        $this->version = $version;

        return $this;
    }

    /**
     * @throws BuilderException
     */
    public function build(): Keycloak
    {
        if (!$this->baseUrl) {
            throw new BuilderException('Base URL is not set');
        }

        if (!$this->grantType) {
            throw new BuilderException('Grant type is not set');
        }

        // @phpstan-ignore method.deprecated
        return new Keycloak(
            baseUrl: $this->baseUrl,
            tokenStorage: $this->tokenStorage,
            httpClient: $this->httpClient,
            grantType: $this->grantType,
            version: $this->version,
        );
    }
}
