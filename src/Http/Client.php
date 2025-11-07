<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use DateTime;
use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\GrantType;
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
    private GrantType $grantType;

    public function __construct(
        private readonly Keycloak $keycloak,
        private readonly ClientInterface $httpClient,
        private readonly TokenStorageInterface $tokenStorage,
    ) {
        if ($grantType = $this->keycloak->getGrantType()) {
            $this->grantType = $grantType;
        } else {
            $this->grantType = GrantType::password(
                // @phpstan-ignore method.deprecated
                $this->keycloak->getUsername() ?? throw new \InvalidArgumentException('Username must be provided'),
                // @phpstan-ignore method.deprecated
                $this->keycloak->getPassword() ?? throw new \InvalidArgumentException('Password must be provided'),
                'admin-cli',
                // @phpstan-ignore method.deprecated
                $this->keycloak->getRealm() ?? throw new \InvalidArgumentException('Realm must be provided'),
            );
        }
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

        if ($tokens['refresh_token']) {
            // The refresh token could be null if the grant type (e.g. client credentials) does not support it
            $this->tokenStorage->storeRefreshToken($parser->parse($tokens['refresh_token']));
        }
    }

    /**
     * @return array{access_token: non-empty-string, refresh_token: non-empty-string|null}
     */
    private function fetchTokens(): array
    {
        if ($refreshToken = $this->tokenStorage->retrieveRefreshToken()) {
            $refreshTokenGrantType = new RefreshToken(
                $this->grantType->clientId,
                $refreshToken->toString(),
                $this->grantType->clientSecret,
                $this->grantType->scope,
            );

            $response = $this->httpClient->request(
                'POST',
                $this->keycloak->getBaseUrl() . '/realms/' . $this->grantType->realm . '/protocol/openid-connect/token',
                [
                    'form_params' => $refreshTokenGrantType->toRequestParams(),
                ],
            );
        } else {
            $response = $this->httpClient->request(
                'POST',
                $this->keycloak->getBaseUrl() . '/realms/' . $this->grantType->realm . '/protocol/openid-connect/token',
                [
                    'form_params' => $this->grantType->toRequestParams(),
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
            'refresh_token' => $tokens['refresh_token'] ?? null,
        ];
    }
}
