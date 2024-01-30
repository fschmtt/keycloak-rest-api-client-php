<?php

namespace Fschmtt\Keycloak\Http\Client;

use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\TokenStorageInterface;
use GuzzleHttp\ClientInterface;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token;

class RealmClient extends KeycloakClient
{
    public function __construct(
        Keycloak                $keycloak,
        ClientInterface         $httpClient,
        TokenStorageInterface   $tokenStorage,
        private readonly string $realm,
    )
    {
        parent::__construct($keycloak, $httpClient, $tokenStorage);
    }

    /**
     * @return array{access_token: string}
     */
    protected function fetchTokens(): array
    {
        $response = $this->httpClient->request(
            'POST',
            $this->keycloak->getBaseUrl() . sprintf('/realms/%s/protocol/openid-connect/token', $this->realm),
            [
                'form_params' => [
                    'client_id' => $this->keycloak->getClientId(),
                    'client_secret' => $this->keycloak->getClientSecret(),
                    'grant_type' => 'client_credentials',
                ],
            ]
        );

        $tokens = json_decode(
            $response->getBody()->getContents(),
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        return ['access_token' => $tokens['access_token']];
    }

    protected function authorize(): void
    {
        $tokens = $this->fetchTokens();
        $parser = (new Token\Parser(new JoseEncoder()));

        $this->tokenStorage->storeAccessToken($parser->parse($tokens['access_token']));
    }
}
