<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Collection\Collection;
use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Representation\Group;
use Fschmtt\Keycloak\Serializer\CollectionSerializer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CollectionSerializer::class)]
class CollectionSerializerTest extends TestCase
{
    public function testSerializes(): void
    {
        static::assertSame(
            Collection::class,
            (new CollectionSerializer())->serializes(),
        );
    }

    public function testSerializesCollection(): void
    {
        $serializer = new CollectionSerializer();
        $groupCollection = $serializer->serialize(GroupCollection::class, [
            new Group(),
            [],
        ]);

        static::assertInstanceOf(GroupCollection::class, $groupCollection);
        static::assertCount(2, $groupCollection);
    }
}
