<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantTypeInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class ClientCredentials implements GrantTypeInterface
{
    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
    ) {}

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function fetchTokens(ClientInterface $httpClient, string $baseUrl, ?string $refreshToken = null): array
    {
        $response = $httpClient->request(
            'POST',
            $baseUrl . '/realms/master/protocol/openid-connect/token',
            [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ],
            ],
        );

        $tokens = json_decode(
            $response->getBody()->getContents(),
            associative: true,
            flags: JSON_THROW_ON_ERROR,
        );

        return [
            'access_token' => $tokens['access_token'],
            'refresh_token' => null,
        ];
    }
}
