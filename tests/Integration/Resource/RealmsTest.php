<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestCase;

class RealmsTest extends IntegrationTestCase
{
    public function testCanGetAllRealms(): void
    {
        $realms = $this->keycloak->realms()->all();

        foreach ($realms as $realm) {
            static::assertInstanceOf(Realm::class, $realm);
        }
    }

    public function testCanGetRealm(): void
    {
        $realm = $this->keycloak->realms()->get(realm: 'master');

        static::assertEquals('master', $realm->getRealm());
    }

    public function testCanUpdateRealm(): void
    {
        $realm = $this->keycloak->realms()->get(realm: 'master');

        static::assertFalse($realm->getRegistrationAllowed());

        $realm = $realm->withRegistrationAllowed(true);
        $realm = $this->keycloak->realms()->update($realm);

        static::assertTrue($realm->getRegistrationAllowed());
    }

    public function testCanImportRealm(): void
    {
        $realm = new Realm(id: 'testing-id', realm: 'testing-realm');
        $realm = $this->keycloak->realms()->import(realm: $realm);

        static::assertEquals('testing-id', $realm->getId());
        static::assertEquals('testing-realm', $realm->getRealm());

        static::assertCount(2, $this->keycloak->realms()->all());
    }

    public function testCanClearCaches(): void
    {
        static::expectNotToPerformAssertions();
        
        $realm = new Realm(realm: 'master');

        $this->keycloak->realms()->clearKeysCache($realm);
        $this->keycloak->realms()->clearRealmCache($realm);
        $this->keycloak->realms()->clearUserCache($realm);
    }

    public function testCanGetClients(): void
    {
        $realm = new Realm(realm: 'master');

        $clients = $this->keycloak->realms()->clients($realm);

        static::assertCount(7, $clients);
    }

    public function testCanGetUsers(): void
    {
        $realm = new Realm(realm: 'master');

        $users = $this->keycloak->realms()->users($realm);

        static::assertCount(1, $users);
    }
}
