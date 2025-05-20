<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantTypeInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Psr\Http\Message\ResponseInterface;

class Password implements GrantTypeInterface
{
    public function __construct(
        private readonly string $username,
        private readonly string $password,
        private readonly string $clientId = 'admin-cli',
    ) {}

    /**
     * @throws JsonException|GuzzleException
     */
    public function fetchTokens(ClientInterface $httpClient, string $baseUrl, ?string $refreshToken = null): array
    {
        if ($refreshToken) {
            try {
                $response = $this->getTokensWithRefreshToken($httpClient, $baseUrl, $refreshToken);
            } catch (ClientException) {
                $response = $this->getTokensWithPassword($httpClient, $baseUrl);
            }
        } else {
            $response = $this->getTokensWithPassword($httpClient, $baseUrl);
        }

        $tokens = json_decode(
            $response->getBody()->getContents(),
            associative: true,
            flags: JSON_THROW_ON_ERROR,
        );

        return [
            'access_token' => $tokens['access_token'],
            'refresh_token' => $tokens['refresh_token'] ?? null,
        ];
    }

    /**
     * @throws GuzzleException
     */
    private function getTokensWithRefreshToken(
        ClientInterface $httpClient,
        string $baseUrl,
        string $refreshToken,
    ): ResponseInterface {
        return $httpClient->request(
            'POST',
            $baseUrl . '/realms/master/protocol/openid-connect/token',
            [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'client_id' => $this->clientId,
                    'refresh_token' => $refreshToken,
                ],
            ],
        );
    }

    /**
     * @throws GuzzleException
     */
    private function getTokensWithPassword(ClientInterface $httpClient, string $baseUrl): ResponseInterface
    {
        return $httpClient->request(
            'POST',
            $baseUrl . '/realms/master/protocol/openid-connect/token',
            [
                'form_params' => [
                    'grant_type' => 'password',
                    'username' => $this->username,
                    'password' => $this->password,
                    'client_id' => $this->clientId,
                ],
            ],
        );
    }
}
