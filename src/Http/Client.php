<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use DateTime;
use Fschmtt\Keycloak\Keycloak;
use GuzzleHttp\Client as GuzzleClient;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private ?Token $accessToken = null;

    public function __construct(
        private readonly Keycloak $keycloak,
        private GuzzleClient $httpClient,
    ) {
    }

    public function request(string $method, string $path = '', array $options = []): ResponseInterface
    {
        if (!$this->isAuthorized()) {
            $this->authorize();
        }

        $defaultOptions = [
            'base_uri' => $this->keycloak->getBaseUrl(),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken->toString(),
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
        return $this->accessToken !== null && !$this->accessToken->isExpired(new DateTime());
    }

    private function authorize(): void
    {
        $accessToken = $this->fetchAccessToken();

        $this->accessToken = (new Token\Parser(new JoseEncoder()))->parse($accessToken);
    }

    private function fetchAccessToken(): string
    {
        $response = $this->httpClient->request(
            'POST',
            $this->keycloak->getBaseUrl() . '/realms/master/protocol/openid-connect/token',
            [
                'form_params' => [
                    'username' => $this->keycloak->getUsername(),
                    'password' => $this->keycloak->getPassword(),
                    'client_id' => 'admin-cli',
                    'grant_type' => 'password',
                ],
            ]
        );

        return (string) json_decode(
            json: (string) $response->getBody(),
            flags: JSON_THROW_ON_ERROR,
        )->access_token;
    }
}
