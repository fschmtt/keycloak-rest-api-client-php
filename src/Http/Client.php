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
    private GuzzleClient $httpClient;
    private ?Token $accessToken = null;

    public function __construct(private Keycloak $keycloak)
    {
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
        $accessToken = $this->fetchAccessToken();

        $this->accessToken = (new Token\Parser(new JoseEncoder()))->parse($accessToken);

        $this->httpClient = new GuzzleClient([
            'base_uri' => $this->keycloak->getBaseUrl() . '/auth/admin/',
            'defaults' => [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken->toString(),
                ]
            ]
        ]);
    }

    private function fetchAccessToken(): string
    {
        $response = (new GuzzleClient())->request(
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
        );

        return (string) json_decode((string) $response->getBody())->access_token;
    }
}
