<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantTypeInterface;

class ClientCredentials implements GrantTypeInterface
{
    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
    ) {}

    public function getFetchTokenFormParams(): array
    {
        return [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
    }

    public function getRefreshTokenFormParams(?string $refreshToken): array
    {
        // client_credentials tokens cannot be refreshed, but you could return an empty array or throw an exception.
        return [];
    }
}
