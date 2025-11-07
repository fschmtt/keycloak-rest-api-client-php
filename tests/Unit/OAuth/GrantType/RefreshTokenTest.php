<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantType\RefreshToken;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(RefreshToken::class)]
class RefreshTokenTest extends TestCase
{
    public function testRequestParams(): void
    {
        $refreshToken = new RefreshToken(
            'refresh-token',
            'client-id',
            'realm',
            'client-secret',
            'scope',
        );

        static::assertSame([
            'grant_type' => 'refresh_token',
            'refresh_token' => 'refresh-token',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'scope' => 'scope',
        ], $refreshToken->toRequestParams());
    }
}
