<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantTypeInterface;

class Password implements GrantTypeInterface
{
    public function __construct(
        private readonly string $username,
        private readonly string $password,
        private readonly string $clientId = 'admin-cli',
    ) {}

    public function getFetchTokenFormParams(): array
    {
        return [
            'grant_type' => 'password',
            'username' => $this->username,
            'password' => $this->password,
            'client_id' => $this->clientId,
        ];
    }

    public function getRefreshTokenFormParams(?string $refreshToken): array
    {
        return [
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
            'client_id' => $this->clientId,
        ];
    }
}
