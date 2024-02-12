<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use DateTimeImmutable;
use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\TokenStorage\InMemory as InMemoryTokenStorage;
use Fschmtt\Keycloak\Test\Unit\Stub\Password;
use Fschmtt\Keycloak\Test\Unit\TokenGenerator;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Client::class)]
class ClientTest extends TestCase
{
    use TokenGenerator;

    private Keycloak $keycloak;

    protected function setUp(): void
    {
        $this->keycloak = new Keycloak('http://keycloak:8080', new Password());
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
        $httpClient->expects(static::exactly(2))
            ->method('request')
            ->willReturnOnConsecutiveCalls(
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

    public function testAuthenticatesUsingConfiguredRealm(): void
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

        $history = [];
        $historyMiddleware = Middleware::history($history);

        $mockHandler = new MockHandler([
            $authorizationResponse,
            $realmsResponse,
        ]);

        $handlerStack = HandlerStack::create($mockHandler);
        $handlerStack->push($historyMiddleware);

        $httpClient = new GuzzleClient(['handler' => $handlerStack]);

        $keycloak = new Keycloak(
            'http://keycloak:8080',
            new Password(realm: 'custom-realm'),
        );

        $client = new Client($keycloak, $httpClient, new InMemoryTokenStorage());

        $client->request('GET', '/admin/realms');

        // Verify that any token endpoint call uses the configured realm in the URL
        static::assertNotEmpty($history);
        $tokenCalls = array_values(array_filter((array) $history, function (array $transaction): bool {
            /** @var Request $request */
            $request = $transaction['request'];
            return str_contains((string) $request->getUri(), '/protocol/openid-connect/token');
        }));
        static::assertNotEmpty($tokenCalls);
        foreach ($tokenCalls as $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $authUri = (string) $request->getUri();
            static::assertStringContainsString('/realms/custom-realm/', $authUri);
            static::assertStringNotContainsString('/realms/master/', $authUri);
        }

        static::assertTrue($client->isAuthorized());
    }
}
