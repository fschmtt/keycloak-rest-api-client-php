<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit;

use DateTimeImmutable;
use Fschmtt\Keycloak\Exception\VersionDetectionException;
use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\Test\Unit\Stub\Password;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

#[CoversClass(Keycloak::class)]
class KeycloakTest extends TestCase
{
    use TokenGenerator;

    /**
     * @var list<string>
     */
    private array $requestedPaths = [];

    protected function setUp(): void
    {
        $this->requestedPaths = [];
    }

    public function testDetectsVersionFromServerInfo(): void
    {
        $keycloak = $this->createKeycloak([
            $this->tokenResponse(),
            $this->serverInfoResponse(['systemInfo' => ['version' => '26.7.2']]),
        ]);

        static::assertSame('26.7.2', $keycloak->getVersion());
    }

    public function testDetectsVersionOnlyOnceAcrossResourceAccessors(): void
    {
        // Queue five responses; only one may be consumed
        $keycloak = $this->createKeycloak([
            $this->tokenResponse(),
            ...array_fill(0, 5, $this->serverInfoResponse(['systemInfo' => ['version' => '26.3.0']])),
        ]);

        $keycloak->users();
        $keycloak->groups();
        $keycloak->roles();
        $keycloak->clients();

        static::assertSame('26.3.0', $keycloak->getVersion());
        static::assertSame(1, $this->countServerInfoRequests());
    }

    /**
     * @param array<string, mixed> $serverInfo
     */
    #[DataProvider('undetectableServerInfoProvider')]
    public function testResourceAccessorsStillWorkWhenVersionIsNotDetectable(array $serverInfo): void
    {
        $keycloak = $this->createKeycloak([
            $this->tokenResponse(),
            $this->serverInfoResponse($serverInfo),
        ]);

        $keycloak->users();
        $keycloak->groups();
        $keycloak->roles();
        $keycloak->clients();
        $keycloak->realms();
        $keycloak->organizations();
        $keycloak->attackDetection();

        static::assertSame(1, $this->countServerInfoRequests());
    }

    public function testDetectedVersionIsWiredIntoEveryExecutor(): void
    {
        $keycloak = $this->createKeycloak([
            $this->tokenResponse(),
            $this->serverInfoResponse(['systemInfo' => ['version' => '26.7.2']]),
        ]);

        $keycloak->users();

        $serializer = $this->readProperty($keycloak, 'serializer');

        static::assertSame($serializer, $this->readProperty($this->readProperty($keycloak, 'commandExecutor'), 'serializer'));
        static::assertSame($serializer, $this->readProperty($this->readProperty($keycloak, 'queryExecutor'), 'serializer'));
    }

    /**
     * @param array<string, mixed> $serverInfo
     */
    #[DataProvider('undetectableServerInfoProvider')]
    public function testDoesNotRetryFailedDetection(array $serverInfo): void
    {
        // Queue five responses; a non-memoised failure would consume more than one
        $keycloak = $this->createKeycloak([
            $this->tokenResponse(),
            ...array_fill(0, 5, $this->serverInfoResponse($serverInfo)),
        ]);

        $keycloak->users();
        $keycloak->groups();
        $keycloak->roles();
        $keycloak->clients();
        $keycloak->realms();

        static::assertSame(1, $this->countServerInfoRequests());
    }

    /**
     * @param array<string, mixed> $serverInfo
     */
    #[DataProvider('undetectableServerInfoProvider')]
    public function testGetVersionThrowsWhenVersionIsNotDetectable(array $serverInfo): void
    {
        $keycloak = $this->createKeycloak([
            $this->tokenResponse(),
            $this->serverInfoResponse($serverInfo),
        ]);

        $this->expectException(VersionDetectionException::class);
        $this->expectExceptionMessage('Could not determine the Keycloak version');

        $keycloak->getVersion();
    }

    public static function undetectableServerInfoProvider(): \Generator
    {
        yield 'systemInfo omitted entirely' => [['profileInfo' => []]];
        yield 'systemInfo present without a version' => [['systemInfo' => ['fileEncoding' => 'UTF-8']]];
    }

    public function testPinnedVersionSkipsDetection(): void
    {
        $keycloak = $this->createKeycloak([], '26.7.2');

        $keycloak->users();
        $keycloak->groups();

        static::assertSame('26.7.2', $keycloak->getVersion());
        static::assertSame([], $this->requestedPaths);
    }

    /**
     * @param list<Response> $responses
     */
    private function createKeycloak(array $responses, ?string $version = null): Keycloak
    {
        $handlerStack = HandlerStack::create(new MockHandler($responses));
        $handlerStack->push($this->recordRequestedPaths());

        // @phpstan-ignore method.deprecated
        return new Keycloak(
            baseUrl: 'http://keycloak:8080',
            httpClient: new GuzzleClient(['handler' => $handlerStack]),
            grantType: new Password(),
            version: $version,
        );
    }

    private function tokenResponse(): Response
    {
        $expiresAt = (new DateTimeImmutable())->modify('+1 hour');

        return new Response(
            status: 200,
            body: json_encode(
                value: [
                    'access_token' => $this->generateToken($expiresAt)->toString(),
                    'refresh_token' => $this->generateToken($expiresAt)->toString(),
                ],
                flags: JSON_THROW_ON_ERROR,
            ),
        );
    }

    /**
     * @param array<string, mixed> $serverInfo
     */
    private function serverInfoResponse(array $serverInfo): Response
    {
        return new Response(
            status: 200,
            body: json_encode(value: $serverInfo, flags: JSON_THROW_ON_ERROR),
        );
    }

    private function recordRequestedPaths(): \Closure
    {
        return fn (callable $handler): \Closure =>
            function (RequestInterface $request, array $options) use ($handler): mixed {
                $this->requestedPaths[] = $request->getUri()->getPath();

                return $handler($request, $options);
            };
    }

    private function readProperty(object $object, string $property): object
    {
        $reflection = new \ReflectionProperty($object, $property);

        return $reflection->getValue($object);
    }

    private function countServerInfoRequests(): int
    {
        return count(array_filter(
            $this->requestedPaths,
            static fn (string $path): bool => $path === '/admin/serverinfo',
        ));
    }
}
