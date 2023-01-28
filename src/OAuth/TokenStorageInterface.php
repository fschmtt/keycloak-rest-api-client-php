<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth;

use Lcobucci\JWT\Token;

interface TokenStorageInterface
{
    public function storeAccessToken(Token $accessToken): void;

    public function storeRefreshToken(Token $refreshToken): void;

    public function retrieveAccessToken(): ?Token;

    public function retrieveRefreshToken(): ?Token;
}
