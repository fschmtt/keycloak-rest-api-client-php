<?php

namespace Fschmtt\Keycloak\Http\Client;

use DateTime;
use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\TokenStorageInterface;
use GuzzleHttp\ClientInterface;

use Psr\Http\Message\ResponseInterface;

abstract class KeycloakClient implements Client
{
    public function __construct(
        protected readonly Keycloak              $keycloak,
        protected readonly ClientInterface       $httpClient,
        protected readonly TokenStorageInterface $tokenStorage,
    )
    {
    }

    /**
     * @param array<string, mixed> $options
     */
    public function request(string $method, string $path = '', array $options = []): ResponseInterface
    {
        if (!$this->isAuthorized()) {
            $this->authorize();
        }

        $defaultOptions = [
            'base_uri' => $this->keycloak->getBaseUrl(),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->tokenStorage->retrieveAccessToken()->toString(),
            ],
        ];

        $options = array_merge_recursive($options, $defaultOptions);

        return $this->httpClient->request(
            $method,
            $this->keycloak->getBaseUrl() . $path,
            $options
        );
    }

    public function isAuthorized(): bool
    {
        return $this->tokenStorage->retrieveAccessToken() !== null && !$this->tokenStorage->retrieveAccessToken()->isExpired(new DateTime());
    }

    protected abstract function authorize(): void;

    /**
     * @return array{access_token: string}
     */
    protected abstract function fetchTokens(): array;
}
