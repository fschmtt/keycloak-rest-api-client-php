<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\OAuth;

use Fschmtt\Keycloak\OAuth\GrantType;
use Fschmtt\Keycloak\OAuth\GrantType\RefreshToken;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(GrantType::class)]
class GrantTypeTest extends TestCase
{
    public function testPassword(): void
    {
        $password = new GrantType\Password(
            'username',
            'password',
            'client-id',
            'realm',
            'client-secret',
            'scope',
        );

        $grantType = GrantType::password(
            'username',
            'password',
            'client-id',
            'realm',
            'client-secret',
            'scope',
        );

        static::assertEquals($password, $grantType);
    }

    public function testClientCredentials(): void
    {
        $clientCredentials = new GrantType\ClientCredentials(
            'client-id',
            'client-secret',
            'realm',
            'scope',
        );

        $grantType = GrantType::clientCredentials(
            'client-id',
            'client-secret',
            'realm',
            'scope',
        );

        static::assertEquals($clientCredentials, $grantType);
    }

    public function testRefreshToken(): void
    {
        $refreshToken = new RefreshToken(
            'refresh-token',
            'client-id',
            'realm',
            'client-secret',
            'scope',
        );

        $grantType = GrantType::refreshToken(
            'refresh-token',
            'client-id',
            'realm',
            'client-secret',
            'scope',
        );

        static::assertEquals($refreshToken, $grantType);
    }
}
