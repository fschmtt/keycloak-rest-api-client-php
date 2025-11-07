<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantType\ClientCredentials;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ClientCredentials::class)]
class ClientCredentialsTest extends TestCase
{
    public function testRequestParams(): void
    {
        $clientCredentials = new ClientCredentials(
            'client-id',
            'client-secret',
            'realm',
            'scope',
        );

        static::assertSame([
            'grant_type' => 'client_credentials',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'scope' => 'scope',
        ], $clientCredentials->toRequestParams());
    }
}
