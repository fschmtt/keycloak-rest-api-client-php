<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Collection;

use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\User;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testCanCreateCollectionWithExpectedRepresentations(): void
    {
        $collection = new UserCollection([
            new User(),
            new User(),
            new User(),
        ]);

        static::assertCount(3, $collection);
    }

    public function testThrowsExceptionIfUnexpectedRepresentationIsProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('UserCollection expects items to be User representation, Realm given');

        new UserCollection([
            new Realm(),
        ]);
    }

    public function testThrowsExceptionIfUnexpectedRepresentationShouldBeAdded(): void
    {
        $collection = new UserCollection([
            new User(),
        ]);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('UserCollection expects items to be User representation, Realm given');

        $collection->add(new Realm());
    }

    public function testCanGetIterator(): void
    {
        $collection = new RealmCollection([
            new Realm(),
            new Realm(),
            new Realm(),
        ]);

        foreach ($collection as $realm) {
            static::assertInstanceOf(Realm::class, $realm);
        }
    }

    public function testSerializeEmptyCollection(): void
    {
        $collection = new RealmCollection([]);

        static::assertEquals([], $collection->jsonSerialize());
    }

    public function testFirstReturnsFirstItemInCollection(): void
    {
        $collection = new RealmCollection([
            new Realm(realm: 'first'),
            new Realm(realm: 'second'),
            new Realm(realm: 'third'),
        ]);

        $realm = $collection->first();

        static::assertInstanceOf(Realm::class, $realm);
        static::assertSame('first', $realm->getRealm());
    }

    public function testFirstReturnsNullIfCollectionIsEmpty(): void
    {
        $collection = new RealmCollection([]);

        static::assertNull($collection->first());
    }
}
