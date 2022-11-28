<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\PropertyFilter\PropertyFilter;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\User;
use Fschmtt\Keycloak\Resource\AttackDetection;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Resource\AttackDetection
 */
class AttackDetectionTest extends TestCase
{
    public function testClearAttackDetectionForAllUsersInRealm(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('DELETE', '/admin/realms/test-realm/attack-detection/brute-force/users');

        $attackDetection = new AttackDetection($httpClient, new PropertyFilter());
        $attackDetection->clear(new Realm(realm: 'test-realm'));
    }

    public function testClearAttackDetectionForSingleUserInRealm(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('DELETE', '/admin/realms/test-realm/attack-detection/brute-force/users/test-user-id');

        $attackDetection = new AttackDetection($httpClient, new PropertyFilter());
        $attackDetection->clearUser(new Realm(realm: 'test-realm'), new User(id: 'test-user-id'));
    }

    public function testGetAttackDetectionForSingleUserInRealm(): void
    {
        $httpClient = $this->createMock(Client::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->with('GET', '/admin/realms/test-realm/attack-detection/brute-force/users/test-user-id')
            ->willReturn(new Response(
                status: 200,
                body: json_encode([], JSON_THROW_ON_ERROR)
            ));

        $attackDetection = new AttackDetection($httpClient, new PropertyFilter());
        $attackDetection->user(new Realm(realm: 'test-realm'), new User(id: 'test-user-id'));
    }
}
