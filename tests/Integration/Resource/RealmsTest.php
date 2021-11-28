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
            self::assertInstanceOf(Realm::class, $realm);
        }
    }

    public function testCanGetRealm(): void
    {
        $realm = $this->keycloak->realms()->get(realm: 'master');

        self::assertEquals('master', $realm->getRealm());
    }

    public function testCanUpdateRealm(): void
    {
        $realm = $this->keycloak->realms()->get(realm: 'master');

        self::assertFalse($realm->getRegistrationAllowed());

        $realm = $realm->withRegistrationAllowed(true);
        $realm = $this->keycloak->realms()->update($realm);

        self::assertTrue($realm->getRegistrationAllowed());
    }

    public function testCanImportRealm(): void
    {
        $realm = new Realm(id: 'testing-id', realm: 'testing-realm');
        $realm = $this->keycloak->realms()->import(realm: $realm);

        self::assertEquals('testing-id', $realm->getId());
        self::assertEquals('testing-realm', $realm->getRealm());

        self::assertCount(2, $this->keycloak->realms()->all());
    }

    public function testCanClearCaches()
    {
        $realm = new Realm(realm: 'master');

        $this->keycloak->realms()->clearKeysCache($realm);
        $this->keycloak->realms()->clearRealmCache($realm);
        $this->keycloak->realms()->clearUserCache($realm);
    }
}
