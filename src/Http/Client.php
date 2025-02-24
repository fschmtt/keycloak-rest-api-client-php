<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use DateTime;
use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\GrantTypeInterface;
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
        private readonly GrantTypeInterface $grantType,
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
        [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ] = $this->grantType->fetchTokens(
            $this->httpClient,
            $this->keycloak->getBaseUrl(),
            $this->tokenStorage->retrieveRefreshToken()?->toString(),
        );

        $parser = (new Token\Parser(new JoseEncoder()));


        $this->tokenStorage->storeAccessToken($parser->parse($accessToken));
        if ($refreshToken) {
            $this->tokenStorage->storeRefreshToken($parser->parse($refreshToken));
        }
    }
}
