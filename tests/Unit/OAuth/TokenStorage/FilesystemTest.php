<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\OAuth\TokenStorage;

use Fschmtt\Keycloak\Exception\TokenStorageException;
use Fschmtt\Keycloak\OAuth\TokenStorage\Filesystem;
use Fschmtt\Keycloak\Test\Unit\TokenGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\OAuth\TokenStorage\Filesystem
 */
class FilesystemTest extends TestCase
{
    use TokenGenerator;

    private string $path;

    private Filesystem $storage;

    protected function setUp(): void
    {
        $this->path = realpath(__DIR__);
        $this->storage = new Filesystem($this->path);
    }

    /**
     * @after
     */
    public function clearTokensFromFilesystem(): void
    {
        @unlink($this->path . '/access_token');
        @unlink($this->path . '/refresh_token');

        static::assertFalse(file_exists($this->path . '/access_token'));
        static::assertFalse(file_exists($this->path . '/refresh_token'));
    }

    public function testReturnsNoAccessTokenIfNotPreviouslySet(): void
    {
        static::assertNull($this->storage->retrieveAccessToken());
    }

    public function testReturnsNoRefreshTokenIfNotPreviouslySet(): void
    {
        static::assertNull($this->storage->retrieveAccessToken());
    }

    public function testReturnsAccessTokenIfPreviouslySet(): void
    {
        $accessToken = $this->generateToken(new \DateTimeImmutable());

        $this->storage->storeAccessToken($accessToken);

        static::assertSame($accessToken, $this->storage->retrieveAccessToken());
    }

    public function testReturnsRefreshTokenIfPreviouslySet(): void
    {
        $refreshToken = $this->generateToken(new \DateTimeImmutable());

        $this->storage->storeRefreshToken($refreshToken);

        static::assertSame($refreshToken, $this->storage->retrieveRefreshToken());
    }

    public function testOverridesPreviouslyStoredAccessToken(): void
    {
        $storedAccessToken = $this->generateToken(new \DateTimeImmutable());
        $newAccessToken = $this->generateToken(new \DateTimeImmutable());

        $this->storage->storeAccessToken($storedAccessToken);

        static::assertSame($storedAccessToken, $this->storage->retrieveAccessToken());

        $this->storage->storeRefreshToken($newAccessToken);

        static::assertNotSame($storedAccessToken, $this->storage->retrieveAccessToken());
        static::assertSame($newAccessToken, $this->storage->retrieveAccessToken());
    }

    public function testOverridesPreviouslyStoredRefreshToken(): void
    {
        $storedRefreshToken = $this->generateToken(new \DateTimeImmutable());
        $newRefreshToken = $this->generateToken(new \DateTimeImmutable());

        $this->storage->storeRefreshToken($storedRefreshToken);

        static::assertSame($storedRefreshToken, $this->storage->retrieveRefreshToken());

        $this->storage->storeRefreshToken($newRefreshToken);

        static::assertNotSame($storedRefreshToken, $this->storage->retrieveRefreshToken());
        static::assertSame($newRefreshToken, $this->storage->retrieveRefreshToken());
    }

    public function testThrowsExceptionIfPathDoesNotExist(): void
    {
        $path = __DIR__ . '/does-not-exist';

        static::expectException(TokenStorageException::class);
        static::expectExceptionMessage(sprintf('Path "%s" does not exist or is not writable', $path));

        new Filesystem($path);
    }
}
