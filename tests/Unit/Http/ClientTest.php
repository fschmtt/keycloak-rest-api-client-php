<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use DateTimeImmutable;
use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\TokenStorage\InMemory as InMemoryTokenStorage;
use Fschmtt\Keycloak\Test\Unit\TokenGenerator;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Client::class)]
class ClientTest extends TestCase
{
    use TokenGenerator;

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
        $accessToken = $this->generateToken((new DateTimeImmutable())->modify('+1 hour'));
        $refreshToken = $this->generateToken((new DateTimeImmutable())->modify('+1 hour'));

        $authorizationResponse = new Response(
            status: 200,
            body: json_encode(
                value: [
                    'access_token' => $accessToken->toString(),
                    'refresh_token' => $refreshToken->toString(),
                ],
                flags: JSON_THROW_ON_ERROR,
            ),
        );

        $realmsResponse = new Response(
            status: 200,
            body: json_encode(
                value: [
                    'realms' => [],
                ],
                flags: JSON_THROW_ON_ERROR,
            ),
        );

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->expects(static::exactly(3))
            ->method('request')
            ->willReturnOnConsecutiveCalls(
                $this->throwException($this->createMock(ClientException::class)),
                $authorizationResponse,
                $realmsResponse,
            );

        $client = new Client($this->keycloak, $httpClient, new InMemoryTokenStorage());
        $client->request('GET', '/admin/realms');

        static::assertTrue($client->isAuthorized());
    }

    public function testIsNotAuthorizedIfTokenStorageContainsNoAccessToken(): void
    {
        $client = new Client(
            $this->keycloak,
            $this->createMock(ClientInterface::class),
            new InMemoryTokenStorage(),
        );

        static::assertFalse($client->isAuthorized());
    }

    public function testIsNotAuthorizedIfTokenStorageContainsExpiredAccessToken(): void
    {
        $accessToken = $this->generateToken((new DateTimeImmutable())->modify('-1 hour'));

        $tokenStorage = new InMemoryTokenStorage();
        $tokenStorage->storeAccessToken($accessToken);

        $client = new Client(
            $this->keycloak,
            $this->createMock(ClientInterface::class),
            $tokenStorage,
        );

        static::assertFalse($client->isAuthorized());
    }

    public function testIsAuthorizedIfTokenStorageContainsUnexpiredAccessToken(): void
    {
        $accessToken = $this->generateToken((new DateTimeImmutable())->modify('+1 hour'));

        $tokenStorage = new InMemoryTokenStorage();
        $tokenStorage->storeAccessToken($accessToken);

        $client = new Client(
            $this->keycloak,
            $this->createMock(ClientInterface::class),
            $tokenStorage,
        );

        static::assertTrue($client->isAuthorized());
    }
}
