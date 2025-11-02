<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\Event\KeycloakEvent;
use Fschmtt\Keycloak\Exception\BuilderException;
use Fschmtt\Keycloak\OAuth\GrantType;
use Fschmtt\Keycloak\OAuth\TokenStorage\InMemory as InMemoryTokenStorage;
use Fschmtt\Keycloak\OAuth\TokenStorageInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Builder
{
    private ?string $baseUrl = null;

    private ?GrantType $grantType = null;

    private TokenStorageInterface $tokenStorage;

    private ClientInterface $httpClient;

    private EventDispatcherInterface $eventDispatcher;

    public function __construct()
    {
        $this->tokenStorage = new InMemoryTokenStorage();
        $this->httpClient = new GuzzleClient();
        $this->eventDispatcher = new EventDispatcher();
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
     * @param array<class-string<KeycloakEvent>, callable> $listeners
     */
    public function withEventListeners(array $listeners): self
    {
        foreach ($listeners as $event => $listener) {
            $this->eventDispatcher->addListener($event, $listener);
        }

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
            eventDispatcher: $this->eventDispatcher,
        );
    }
}
