<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Exception\SerializerException;
use Fschmtt\Keycloak\Type\Map;
use PHPUnit\Framework\TestCase;
use stdClass;

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
    public function testSerializesKnownTypes(string $type, mixed $value, mixed $expected): void
    {
        static::assertEquals(
            $this->serializer->serialize($type, $value),
            $expected
        );
    }

    public function testThrowsExceptionForUnknownType(): void
    {
        $this->expectException(SerializerException::class);
        $this->expectExceptionMessage(
            sprintf('No matching serializer found for type "%s"', stdClass::class)
        );

        $this->serializer->serialize(stdClass::class, '');
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
