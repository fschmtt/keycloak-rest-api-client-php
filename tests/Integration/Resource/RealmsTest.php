<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestBehaviour;
use Fschmtt\Keycloak\Type\Map;
use PHPUnit\Framework\TestCase;

class RealmsTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testCanGetAllRealms(): void
    {
        $realms = $this->getKeycloak()->realms()->all();

        static::assertInstanceOf(RealmCollection::class, $realms);
        static::assertGreaterThanOrEqual(1, $realms->count());
    }

    public function testCanGetRealm(): void
    {
        $realm = $this->getKeycloak()->realms()->get(realm: 'master');

        static::assertEquals('master', $realm->getRealm());
    }

    public function testCanGetRealmKeys(): void
    {
        $realmkeys = $this->getKeycloak()->realms()->keys(realm: 'master');
        static::assertArrayHasKey('AES', $realmkeys->getActive());
        static::assertGreaterThan(1, $realmkeys->getKeys()->count());
    }

    public function testCanUpdateRealm(): void
    {
        $realm = $this->getKeycloak()->realms()->get(realm: 'master');

        static::assertFalse($realm->getRegistrationAllowed());

        $realm = $realm->withRegistrationAllowed(true);
        $realm = $this->keycloak->realms()->update($realm->getRealm(), $realm);

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

        $this->getKeycloak()->realms()->clearKeysCache($realm->getRealm());
        $this->getKeycloak()->realms()->clearRealmCache($realm->getRealm());
        $this->getKeycloak()->realms()->clearUserCache($realm->getRealm());
    }

    public function testCanClearKeysCache(): void
    {
        $this->expectNotToPerformAssertions();

        $this->getKeycloak()->realms()->clearKeysCache('master');
    }

    public function testCanClearRealmCache(): void
    {
        $this->expectNotToPerformAssertions();

        $this->getKeycloak()->realms()->clearRealmCache('master');
    }

    public function testCanClearUserCache(): void
    {
        $this->expectNotToPerformAssertions();

        $this->getKeycloak()->realms()->clearUserCache('master');
    }

    public function testCanGetAdminEvents(): void
    {
        $adminEvents = $this->getKeycloak()->realms()->adminEvents('master');

        static::assertEmpty($adminEvents);
    }

    public function testCanDeleteAdminEvents(): void
    {
        $this->expectNotToPerformAssertions();

        $this->getKeycloak()->realms()->deleteAdminEvents('master');
    }

    public function testCanUpdateRealmAttributes(): void
    {
        $realm = $this->getKeycloak()->realms()->get(realm: 'master');

        static::assertNull($realm->getAttributes()->map['termsUrl']);

        $realm = $realm->withAttributes(new Map([
            'termsUrl' => 'https://example.com/terms',
        ]));

        $this->getKeycloak()->realms()->update($realm->getRealm(), $realm);

        $updatedRealm = $this->getKeycloak()->realms()->get(realm: $realm->getRealm());

        static::assertEquals('https://example.com/terms', $updatedRealm->getAttributes()->map['termsUrl']);
    }
}
