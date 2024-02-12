<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth;

use Fschmtt\Keycloak\OAuth\GrantType\ClientCredentials;
use Fschmtt\Keycloak\OAuth\GrantType\Password;
use Fschmtt\Keycloak\OAuth\GrantType\RefreshToken;

abstract class GrantType
{
    public function __construct(
        public readonly string $grantType,
        public readonly string $clientId,
        public readonly string $realm = 'master',
        public readonly ?string $clientSecret = null,
        public readonly ?string $scope = null,
    ) {}

    /**
     * @return array<string, string>
     */
    abstract public function toRequestParams(): array;

    public static function password(
        string $username,
        string $password,
        string $clientId = 'admin-cli',
        ?string $realm = 'master',
        ?string $clientSecret = null,
        ?string $scope = null,
    ): Password {
        return new Password($username, $password, $clientId, $realm, $clientSecret, $scope);
    }

    public static function clientCredentials(
        string $clientId,
        string $clientSecret,
        ?string $realm = 'master',
        ?string $scope = null,
    ): ClientCredentials {
        return new ClientCredentials($clientId, $clientSecret, $realm, $scope);
    }

    public static function refreshToken(
        string $refreshToken,
        string $clientId = 'admin-cli',
        ?string $realm = 'master',
        ?string $clientSecret = null,
        ?string $scope = null,
    ): RefreshToken {
        return new RefreshToken($refreshToken, $clientId, $realm, $clientSecret, $scope);
    }
}
