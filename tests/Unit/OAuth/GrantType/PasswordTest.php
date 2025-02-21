<?php

namespace Fschmtt\Keycloak\Test\Unit\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantType\Password;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Password::class)]
class PasswordTest extends TestCase
{
    public function testGetFetchTokenFormParams(): void
    {
        $passwordGrant = new Password('admin', 'admin', 'admin-cli');
        $params = $passwordGrant->getFetchTokenFormParams();

        static::assertSame(
            [
                'grant_type' => 'password',
                'username' => 'admin',
                'password' => 'admin',
                'client_id' => 'admin-cli',
            ],
            $params,
        );
    }

    public function testGetRefreshTokenFormParams(): void
    {
        $passwordGrant = new Password('admin', 'admin', 'admin-cli');
        $params = $passwordGrant->getRefreshTokenFormParams('refreshToken');

        static::assertSame(
            [
                'refresh_token' => 'refreshToken',
                'grant_type' => 'refresh_token',
                'client_id' => 'admin-cli',
            ],
            $params,
        );
    }
}
