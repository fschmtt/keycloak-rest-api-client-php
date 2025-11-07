<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantType\Password;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Password::class)]
class PasswordTest extends TestCase
{
    public function testRequestParams(): void
    {
        $password = new Password(
            'username',
            'password',
            'client-id',
            'realn',
            'client-secret',
            'scope',
        );

        static::assertSame([
            'grant_type' => 'password',
            'username' => 'username',
            'password' => 'password',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'scope' => 'scope',
        ], $password->toRequestParams());
    }
}
