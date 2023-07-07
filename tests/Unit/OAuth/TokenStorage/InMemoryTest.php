<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\OAuth\TokenStorage;

use Fschmtt\Keycloak\OAuth\TokenStorage\InMemory;
use Fschmtt\Keycloak\Test\Unit\TokenGenerator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(InMemory::class)]
class InMemoryTest extends TestCase
{
    use TokenGenerator;

    public function testReturnsNoAccessTokenIfNotPreviouslySet(): void
    {
        static::assertNull((new InMemory())->retrieveAccessToken());
    }

    public function testReturnsNoRefreshTokenIfNotPreviouslySet(): void
    {
        static::assertNull((new InMemory())->retrieveAccessToken());
    }

    public function testReturnsAccessTokenIfPreviouslySet(): void
    {
        $accessToken = $this->generateToken(new \DateTimeImmutable());

        $storage = new InMemory();
        $storage->storeAccessToken($accessToken);

        static::assertSame($accessToken, $storage->retrieveAccessToken());
    }

    public function testReturnsRefreshTokenIfPreviouslySet(): void
    {
        $refreshToken = $this->generateToken(new \DateTimeImmutable());

        $storage = new InMemory();
        $storage->storeRefreshToken($refreshToken);

        static::assertSame($refreshToken, $storage->retrieveRefreshToken());
    }

    public function testOverridesPreviouslyStoredAccessToken(): void
    {
        $storedAccessToken = $this->generateToken(new \DateTimeImmutable());
        $newAccessToken = $this->generateToken(new \DateTimeImmutable());

        $storage = new InMemory();
        $storage->storeAccessToken($storedAccessToken);

        static::assertSame($storedAccessToken, $storage->retrieveAccessToken());

        $storage->storeAccessToken($newAccessToken);

        static::assertNotSame($storedAccessToken, $storage->retrieveAccessToken());
        static::assertSame($newAccessToken, $storage->retrieveAccessToken());
    }

    public function testOverridesPreviouslyStoredRefreshToken(): void
    {
        $storedRefreshToken = $this->generateToken(new \DateTimeImmutable());
        $newRefreshToken = $this->generateToken(new \DateTimeImmutable());

        $storage = new InMemory();
        $storage->storeRefreshToken($storedRefreshToken);

        static::assertSame($storedRefreshToken, $storage->retrieveRefreshToken());

        $storage->storeRefreshToken($newRefreshToken);

        static::assertNotSame($storedRefreshToken, $storage->retrieveRefreshToken());
        static::assertSame($newRefreshToken, $storage->retrieveRefreshToken());
    }
}
