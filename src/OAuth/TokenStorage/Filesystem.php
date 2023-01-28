<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth\TokenStorage;

use Fschmtt\Keycloak\Exception\TokenStorageException;
use Fschmtt\Keycloak\OAuth\TokenStorageInterface;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token;

class Filesystem implements TokenStorageInterface
{
    private string $accessTokenPath;

    private string $refreshTokenPath;

    private ?Token $accessToken = null;

    private ?Token $refreshToken = null;

    public function __construct(string $path)
    {
        $realPath = realpath($path);

        if (!$realPath) {
            throw new TokenStorageException(sprintf('Path "%s" does not exist or is not writable', $path));
        }

        $this->accessTokenPath = $realPath . '/access_token';
        $this->refreshTokenPath = $realPath . '/refresh_token';
    }

    public function storeAccessToken(Token $accessToken): void
    {
        if (@file_put_contents($this->accessTokenPath, $accessToken->toString()) === false) {
            throw new TokenStorageException('Could not store access token on filesystem');
        }

        $this->accessToken = $accessToken;
    }

    public function storeRefreshToken(Token $refreshToken): void
    {
        if (@file_put_contents($this->refreshTokenPath, $refreshToken->toString()) === false) {
            throw new TokenStorageException('Could not store refresh token on filesystem');
        }

        $this->refreshToken = $refreshToken;
    }

    public function retrieveAccessToken(): ?Token
    {
        if ($this->accessToken) {
            return $this->accessToken;
        }

        if (!file_exists($this->accessTokenPath)) {
            return null;
        }

        $token = @file_get_contents($this->accessTokenPath);

        if ($token === false) {
            throw new TokenStorageException('Could not retrieve access token from filesystem');
        }

        $this->accessToken = (new Token\Parser(new JoseEncoder()))->parse($token);

        return $this->accessToken;
    }

    public function retrieveRefreshToken(): ?Token
    {
        if ($this->refreshToken) {
            return $this->refreshToken;
        }

        if (!file_exists($this->refreshTokenPath)) {
            return null;
        }

        $token = @file_get_contents($this->refreshTokenPath);

        if ($token === false) {
            throw new TokenStorageException('Could not retrieve refresh token from filesystem');
        }

        $this->refreshToken = (new Token\Parser(new JoseEncoder()))->parse($token);

        return $this->refreshToken;
    }
}
