<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\Representation;
use Fschmtt\Keycloak\Serializer\RepresentationSerializer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(RepresentationSerializer::class)]
class RepresentationSerializerTest extends TestCase
{
    public function testSerializes(): void
    {
        static::assertSame(
            Representation::class,
            (new RepresentationSerializer())->serializes()
        );
    }

    public function testSerializesRepresentation(): void
    {
        $serializer = new RepresentationSerializer();
        $realm = $serializer->serialize(Realm::class, [
            'realm' => 'test',
        ]);

        static::assertInstanceOf(Realm::class, $realm);
        static::assertSame('test', $realm->getRealm());
    }
}
