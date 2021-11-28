<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Exception\SerializerException;
use Fschmtt\Keycloak\Representation\JsonNode;
use Fschmtt\Keycloak\Representation\Representation;
use Fschmtt\Keycloak\Type\Map;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Serializer\Serializer
 */
class SerializerTest extends TestCase
{
    private Serializer $serializer;

    public function setUp(): void
    {
        $this->serializer = (new Factory())->create();
    }

    /**
     * @dataProvider provideKnownTypes
     */
    public function testSerializesKnownTypes(string $type, mixed $value, mixed $expected)
    {
        static::assertEquals(
            $this->serializer->serialize($type, $value),
            $expected
        );
    }

    public function testThrowsExceptionForUnknownType()
    {
        static::expectException(SerializerException::class);
        static::expectExceptionMessage(
            sprintf('No matching serializer found for type "%s"', Representation::class)
        );

        $this->serializer->serialize(Representation::class, '');
    }

    public function provideKnownTypes(): array
    {
        return [
            ['bool', 'false', false],
            ['int', '1337', 1337],
            //[JsonNode::class, ['foo' => 'bar'], new JsonNode(['foo' => 'bar'])],
            [Map::class, ['foo' => 'bar'], new Map(['foo' => 'bar'])],
            ['string', 'Howdy', 'Howdy']
        ];
    }
}
