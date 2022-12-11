<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use DateTimeImmutable;
use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Keycloak;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Builder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Http\Client
 */
class ClientTest extends TestCase
{
    private Keycloak $keycloak;

    protected function setUp(): void
    {
        $this->keycloak = new Keycloak(
            'http://keycloak:8080',
            'admin',
            'admin',
        );
    }

    public function testAuthorizesBeforeSendingRequest(): void
    {
        $accessToken = $this->generateAccessToken((new DateTimeImmutable())->modify('+1 hour'));

        $authorizationResponse = new Response(
            status: 200,
            body: json_encode(
                value: [
                    'access_token' => $accessToken->toString(),
                ],
                flags: JSON_THROW_ON_ERROR
            ),
        );

        $realmsResponse = new Response(
            status: 200,
            body: json_encode(
                value: [
                    'realms' => [],
                ],
                flags: JSON_THROW_ON_ERROR
            ),
        );

        $httpClient = $this->createMock(GuzzleClient::class);
        $httpClient->expects(static::exactly(2))
            ->method('request')
            ->withConsecutive(
                [
                    'POST',
                    sprintf('%s/realms/master/protocol/openid-connect/token', $this->keycloak->getBaseUrl()),
                    [
                        'form_params' => [
                            'client_id' => 'admin-cli',
                            'username' => $this->keycloak->getUsername(),
                            'password' => $this->keycloak->getPassword(),
                            'grant_type' => 'password',
                        ],
                    ],
                ],
                [
                    'GET',
                    sprintf('%s/admin/realms', $this->keycloak->getBaseUrl()),
                    [
                        'base_uri' => $this->keycloak->getBaseUrl(),
                        'headers' => [
                            'Authorization' => 'Bearer ' . $accessToken->toString(),
                        ],
                    ],
                ],
            )->willReturnOnConsecutiveCalls(
                $authorizationResponse,
                $realmsResponse,
            );

        $client = new Client($this->keycloak, $httpClient);
        $client->request('GET', '/admin/realms');

        static::assertTrue($client->isAuthorized());
    }

    public function testReAuthorizesIfAccessTokenHasExpired(): void
    {
        $expiredAccessToken = $this->generateAccessToken((new DateTimeImmutable())->modify('-1 hour'));
        $validAccessToken = $this->generateAccessToken((new DateTimeImmutable())->modify('+1 hour'));

        $expiredAuthorizationResponse = new Response(
            status: 200,
            body: json_encode(
                value: [
                    'access_token' => $expiredAccessToken->toString(),
                ],
                flags: JSON_THROW_ON_ERROR
            ),
        );

        $validAuthorizationResponse = new Response(
            status: 200,
            body: json_encode(
                value: [
                    'access_token' => $validAccessToken->toString(),
                ],
                flags: JSON_THROW_ON_ERROR
            ),
        );

        $realmsResponse = new Response(
            status: 200,
            body: json_encode(
                value: [
                    'realms' => [],
                ],
                flags: JSON_THROW_ON_ERROR
            ),
        );

        $httpClient = $this->createMock(GuzzleClient::class);
        $httpClient->expects(static::exactly(4))
            ->method('request')
            ->withConsecutive(
                [
                    'POST',
                    sprintf('%s/realms/master/protocol/openid-connect/token', $this->keycloak->getBaseUrl()),
                    [
                        'form_params' => [
                            'client_id' => 'admin-cli',
                            'username' => $this->keycloak->getUsername(),
                            'password' => $this->keycloak->getPassword(),
                            'grant_type' => 'password',
                        ],
                    ],
                ],
                [
                    'GET',
                    sprintf('%s/admin/realms', $this->keycloak->getBaseUrl()),
                    [
                        'base_uri' => $this->keycloak->getBaseUrl(),
                        'headers' => [
                            'Authorization' => 'Bearer ' . $expiredAccessToken->toString(),
                        ],
                    ],
                ],
                [
                    'POST',
                    sprintf('%s/realms/master/protocol/openid-connect/token', $this->keycloak->getBaseUrl()),
                    [
                        'form_params' => [
                            'client_id' => 'admin-cli',
                            'username' => $this->keycloak->getUsername(),
                            'password' => $this->keycloak->getPassword(),
                            'grant_type' => 'password',
                        ],
                    ],
                ],
                [
                    'GET',
                    sprintf('%s/admin/realms', $this->keycloak->getBaseUrl()),
                    [
                        'base_uri' => $this->keycloak->getBaseUrl(),
                        'headers' => [
                            'Authorization' => 'Bearer ' . $validAccessToken->toString(),
                        ],
                    ],
                ],
            )->willReturnOnConsecutiveCalls(
                $expiredAuthorizationResponse,
                $realmsResponse,
                $validAuthorizationResponse,
                $realmsResponse,
            );

        $client = new Client($this->keycloak, $httpClient);
        $client->request('GET', '/admin/realms');
        static::assertFalse($client->isAuthorized());

        $client->request('GET', '/admin/realms');
        static::assertTrue($client->isAuthorized());
    }

    private function generateAccessToken(DateTimeImmutable $expiresAt): Token
    {
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $algorithm = new Sha256();
        $signingKey = InMemory::plainText(random_bytes(32));

        $now = new DateTimeImmutable();
        return $tokenBuilder
            ->issuedAt($now)
            ->expiresAt($expiresAt)
            ->getToken($algorithm, $signingKey);
    }
}
