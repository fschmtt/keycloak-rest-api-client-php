<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use DateTime;
use Fschmtt\Keycloak\Json\JsonDecoder;
use Fschmtt\Keycloak\Keycloak;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private GuzzleClient $httpClient;

    public function __construct(
        private Keycloak $keycloak,
        private ?Token $accessToken = null,
        private ?Token $refreshToken = null
    ) {
    }

    public function request(string $method, string $path = '', array $options = []): ResponseInterface
    {
        if (!$this->isAuthorized()) {
            $this->authorize();
        }

        $defaultOptions = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken->toString(),
            ]
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
        $this->fetchAccessToken();

        $this->httpClient = new GuzzleClient([
            'base_uri' => $this->keycloak->getBaseUrl() . '/auth/admin/',
            'defaults' => [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken->toString(),
                ]
            ]
        ]);
    }

    private function fetchAccessToken(): void
    {
        try {
            $response = (new JsonDecoder())->decode((string) (new GuzzleClient())->request(
                'POST',
                $this->keycloak->getBaseUrl() . '/auth/realms/master/protocol/openid-connect/token',
                [
                    'form_params' => [
                        'refresh_token' => $this->refreshToken,
                        'password' => $this->keycloak->getPassword(),
                        'client_id' => 'admin-cli',
                        'grant_type' => 'refresh_token',
                    ]
                ]
            )->getBody());
        } catch (RequestException $e) {
            // Fall back to grant_type=password ...
            $response = (new JsonDecoder())->decode((string) (new GuzzleClient())->request(
                'POST',
                $this->keycloak->getBaseUrl() . '/auth/realms/master/protocol/openid-connect/token',
                [
                    'form_params' => [
                        'username' => $this->keycloak->getUsername(),
                        'password' => $this->keycloak->getPassword(),
                        'client_id' => 'admin-cli',
                        'grant_type' => 'password',
                    ]
                ]
            )->getBody());
        }

        $this->accessToken = (new Token\Parser(new JoseEncoder()))->parse($response['access_token']);
        $this->refreshToken = (new Token\Parser(new JoseEncoder()))->parse($response['refresh_token']);
    }
}
