<?php

namespace Fschmtt\Keycloak\Test\Unit\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantType\ClientCredentials;
use Fschmtt\Keycloak\OAuth\GrantType\Password;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ClientCredentials::class)]
class ClientCredentialsTest extends TestCase
{
    public function testGetFetchTokenFormParams(): void
    {
        $clientCredentials = new ClientCredentials('clientId', 'clientSecret');
        $params = $clientCredentials->getFetchTokenFormParams();

        static::assertSame(
            [
                'grant_type' => 'client_credentials',
                'client_id' => 'clientId',
                'client_secret' => 'clientSecret',
            ],
            $params,
        );
    }

    public function testGetRefreshTokenFormParams(): void
    {
        $clientCredentials = new ClientCredentials('clientId', 'clientSecret');
        $params = $clientCredentials->getRefreshTokenFormParams('refreshToken');

        static::assertSame(
            [],
            $params,
        );
    }
}
