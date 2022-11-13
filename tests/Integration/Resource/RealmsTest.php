<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestBehaviour;
use PHPUnit\Framework\TestCase;

class RealmsTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testCanGetAllRealms(): void
    {
        $realms = $this->getKeycloak()->realms()->all();

        static::assertInstanceOf(RealmCollection::class, $realms);
        static::assertCount(1, $realms);
    }

    public function testCanGetRealm(): void
    {
        $realm = $this->getKeycloak()->realms()->get(realm: 'master');

        static::assertEquals('master', $realm->getRealm());
    }

    public function testCanUpdateRealm(): void
    {
        $realm = $this->getKeycloak()->realms()->get(realm: 'master');

        static::assertFalse($realm->getRegistrationAllowed());

        $realm = $realm->withRegistrationAllowed(true);
        $realm = $this->keycloak->realms()->update($realm);

        static::assertTrue($realm->getRegistrationAllowed());
    }

    public function testCanImportRealm(): void
    {
        $realm = new Realm(id: 'testing-id', realm: 'testing-realm');
        $realm = $this->getKeycloak()->realms()->import(realm: $realm);

        static::assertEquals('testing-id', $realm->getId());
        static::assertEquals('testing-realm', $realm->getRealm());

        static::assertCount(2, $this->keycloak->realms()->all());
    }

    public function testCanClearCaches(): void
    {
        $this->expectNotToPerformAssertions();

        $realm = new Realm(realm: 'master');

        $this->getKeycloak()->realms()->clearKeysCache($realm);
        $this->getKeycloak()->realms()->clearRealmCache($realm);
        $this->getKeycloak()->realms()->clearUserCache($realm);
    }

    public function testCanGetClients(): void
    {
        $realm = new Realm(realm: 'master');

        $clients = $this->getKeycloak()->realms()->clients($realm);

        static::assertGreaterThan(0, $clients->count());
    }

    public function testCanGetUsers(): void
    {
        $realm = new Realm(realm: 'master');

        $users = $this->getKeycloak()->realms()->users($realm);

        static::assertCount(1, $users);
    }

    public function testCanClearKeysCache(): void
    {
        $this->expectNotToPerformAssertions();

        $this->getKeycloak()->realms()->clearKeysCache(new Realm(realm: 'master'));
    }

    public function testCanClearRealmCache(): void
    {
        $this->expectNotToPerformAssertions();

        $this->getKeycloak()->realms()->clearRealmCache(new Realm(realm: 'master'));
    }

    public function testCanClearUserCache(): void
    {
        $this->expectNotToPerformAssertions();

        $this->getKeycloak()->realms()->clearUserCache(new Realm(realm: 'master'));
    }

    public function testCanGetAdminEvents(): void
    {
        $adminEvents = $this->getKeycloak()->realms()->adminEvents(new Realm(realm: 'master'));

        static::assertEmpty($adminEvents);
    }

    public function testCanDeleteAdminEvents(): void
    {
        $this->expectNotToPerformAssertions();

        $this->getKeycloak()->realms()->deleteAdminEvents(new Realm(realm: 'master'));
    }
}
