<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth\TokenStorage;

use Fschmtt\Keycloak\OAuth\TokenStorageInterface;
use Lcobucci\JWT\Token;

/**
 * @internal
 */
class InMemory implements TokenStorageInterface
{
    private ?Token $accessToken = null;

    private ?Token $refreshToken = null;

    public function storeAccessToken(Token $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function storeRefreshToken(Token $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }

    public function retrieveAccessToken(): ?Token
    {
        return $this->accessToken;
    }

    public function retrieveRefreshToken(): ?Token
    {
        return $this->refreshToken;
    }
}
