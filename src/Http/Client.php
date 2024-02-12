<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use DateTime;
use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\GrantType\RefreshToken;
use Fschmtt\Keycloak\OAuth\TokenStorageInterface;
use GuzzleHttp\ClientInterface;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class Client
{
    public function __construct(
        private readonly Keycloak $keycloak,
        private readonly ClientInterface $httpClient,
        private readonly TokenStorageInterface $tokenStorage,
    ) {}

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
            $options,
        );
    }

    public function isAuthorized(): bool
    {
        return $this->tokenStorage->retrieveAccessToken()?->isExpired(new DateTime()) === false;
    }

    private function authorize(): void
    {
        $tokens = $this->fetchTokens();
        $parser = (new Token\Parser(new JoseEncoder()));

        $this->tokenStorage->storeAccessToken($parser->parse($tokens['access_token']));
        $this->tokenStorage->storeRefreshToken($parser->parse($tokens['refresh_token']));
    }

    /**
     * @return array{access_token: non-empty-string, refresh_token: non-empty-string}
     */
    private function fetchTokens(): array
    {
        if ($refreshToken = $this->tokenStorage->retrieveRefreshToken()) {
            $refreshTokenGrantType = new RefreshToken(
                $this->keycloak->getGrantType()->clientId,
                $refreshToken->toString(),
                $this->keycloak->getGrantType()->clientSecret,
                $this->keycloak->getGrantType()->scope,
            );

            $response = $this->httpClient->request(
                'POST',
                $this->keycloak->getBaseUrl() . '/realms/' . $this->keycloak->getGrantType()->realm . '/protocol/openid-connect/token',
                [
                    'form_params' => $refreshTokenGrantType->toRequestParams(),
                ],
            );
        } else {
            $response = $this->httpClient->request(
                'POST',
                $this->keycloak->getBaseUrl() . '/realms/' . $this->keycloak->getGrantType()->realm . '/protocol/openid-connect/token',
                [
                    'form_params' => $this->keycloak->getGrantType()->toRequestParams(),
                ],
            );
        }

        $tokens = json_decode(
            $response->getBody()->getContents(),
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        return [
            'access_token' => $tokens['access_token'],
            'refresh_token' => $tokens['refresh_token'],
        ];
    }
}
