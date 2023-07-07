<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Exception;
use Fschmtt\Keycloak\Collection\Collection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Enum\Category;
use Fschmtt\Keycloak\Enum\Enum;
use Fschmtt\Keycloak\Exception\SerializerException;
use Fschmtt\Keycloak\Representation\Representation;
use Fschmtt\Keycloak\Representation\Roles;
use Fschmtt\Keycloak\Serializer\Factory;
use Fschmtt\Keycloak\Serializer\Serializer;
use Fschmtt\Keycloak\Type\Map;
use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(Serializer::class)]
class SerializerTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new Factory())->create();
    }

    public function testThrowsExceptionWhenSerializesIsCalled(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(sprintf('Use (new %s)->create())->serialize()', Factory::class));

        $this->serializer->serializes();
    }

    /**
     * @dataProvider provideKnownTypes
     */
    public function testSerializesKnownTypes(string $type, mixed $value, mixed $expected): void
    {
        static::assertEquals(
            $expected,
            $this->serializer->serialize($type, $value),
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

    public static function provideKnownTypes(): Generator
    {
        yield 'bool' => ['bool', 'false', false];
        yield 'int' => ['int', '1337', 1337];
        yield Representation::class => [Roles::class, [], new Roles()];
        yield Map::class => [
            Map::class, [
                'foo' => 'bar',
            ], new Map([
                'foo' => 'bar',
            ]), ];
        yield 'string' => ['string', 'Howdy', 'Howdy'];
        yield Enum::class => [Category::class, 'ADMIN', Category::ADMIN];
        yield Collection::class => [UserCollection::class, [], new UserCollection([])];
        yield 'nullable string' => ['?string', null, null];
    }
}
