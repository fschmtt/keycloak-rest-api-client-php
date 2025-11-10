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
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

#[CoversClass(Client::class)]
class ClientTest extends TestCase
{
    use TokenGenerator;

    private Keycloak $keycloak;

    protected function setUp(): void
    {
        // @phpstan-ignore method.deprecated
        $this->keycloak = new Keycloak(
            'http://keycloak:8080',
            grantType: new Password(),
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

        // @phpstan-ignore method.deprecated
        $keycloak = new Keycloak(
            'http://keycloak:8080',
            grantType: new Password(realm: 'custom-realm'),
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

    #[DataProvider('provideRequiredLegacyCredentials')]
    public function testThrowsExceptionIfRequiredLegacyCredentialIsNotProvided(
        string $expectedExceptionMessage,
        ?string $username,
        ?string $password,
        ?string $realm,
    ): void {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        // @phpstan-ignore method.deprecatedClass,new.deprecatedClass
        new LegacyKeycloak($username, $password, $realm);
    }

    public function testUsesRefreshTokenToAuthorizeWhenPresentInTokenStorage(): void
    {
        $accessToken = $this->generateToken((new DateTimeImmutable())->modify('-1 hour'));
        $refreshToken = $this->generateToken((new DateTimeImmutable())->modify('+1 hour'));

        $tokenStorage = new InMemoryTokenStorage();
        $tokenStorage->storeAccessToken($accessToken);
        $tokenStorage->storeRefreshToken($refreshToken);

        // @phpstan-ignore method.deprecated
        $keycloak = new Keycloak(
            'http://keycloak:8080',
            grantType: new Password(realm: 'custom-realm'),
        );

        $guzzleClient = new GuzzleClient(['handler' => new MockHandler([
            $this->generateTokenResponse(),
            new Response(),
        ])]);

        $client = new Client($keycloak, $guzzleClient, $tokenStorage);
        $client->request('GET', '/admin/realms');

        static::assertNotEquals($tokenStorage->retrieveAccessToken()->toString(), $accessToken->toString());
        static::assertNotEquals($tokenStorage->retrieveRefreshToken()->toString(), $refreshToken->toString());
    }

    public function testUsesGrantTypeToAuthorizeWhenRefreshTokenIsNotPresentInTokenStorage(): void
    {
        $accessToken = $this->generateToken((new DateTimeImmutable())->modify('-1 hour'));

        $tokenStorage = new InMemoryTokenStorage();
        $tokenStorage->storeAccessToken($accessToken);

        // @phpstan-ignore method.deprecated
        $keycloak = new Keycloak(
            'http://keycloak:8080',
            grantType: new Password(realm: 'custom-realm'),
        );

        $guzzleClient = new GuzzleClient(['handler' => new MockHandler([
            $this->generateTokenResponse(false),
            new Response(),
        ])]);

        $client = new Client($keycloak, $guzzleClient, $tokenStorage);
        $client->request('GET', '/admin/realms');

        static::assertNotEquals($tokenStorage->retrieveAccessToken()->toString(), $accessToken->toString());
        static::assertNull($tokenStorage->retrieveRefreshToken());
    }

    /**
     * @deprecated tag:v1.0.0 The legacy credentials will be removed in v1.0.0
     */
    public static function provideRequiredLegacyCredentials(): \Generator
    {
        yield 'no username provided' => [
            'Username must be provided when using legacy credentials',
            null,
            'password',
            'realm',
        ];

        yield 'no password provided' => [
            'Password must be provided when using legacy credentials',
            'username',
            null,
            'realm',
        ];

        yield 'no realm provided' => [
            'Realm must be provided when using legacy credentials',
            'username',
            'password',
            null,
        ];
    }

    private function generateTokenResponse(bool $withRefreshToken = true): ResponseInterface
    {
        $tokens['access_token'] = $this->generateToken((new DateTimeImmutable())->modify('+1 hour'))->toString();
        $tokens['refresh_token'] = $withRefreshToken
            ? $this->generateToken((new DateTimeImmutable())->modify('+1 hour'))->toString()
            : null;

        return new Response(
            body: json_encode(array_filter($tokens), JSON_THROW_ON_ERROR),
        );
    }
}

/**
 * @deprecated tag:v1.0.0 The legacy credentials will be removed in v1.0.0
 */
class LegacyKeycloak extends Keycloak
{
    public function __construct(
        public readonly ?string $username = null,
        public readonly ?string $password = null,
        public readonly ?string $realm = null,
    ) {
        parent::__construct(
            'http://keycloak:8080',
            username: $username,
            password: $password,
            realm: $realm,
            grantType: null,
        );
    }
}
