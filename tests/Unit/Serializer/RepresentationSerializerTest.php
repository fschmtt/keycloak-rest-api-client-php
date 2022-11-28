<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Serializer\RepresentationSerializer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Serializer\RepresentationSerializer
 */
class RepresentationSerializerTest extends TestCase
{
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
