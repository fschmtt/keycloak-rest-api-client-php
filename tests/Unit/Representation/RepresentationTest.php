<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Representation;

use BadMethodCallException;
use Fschmtt\Keycloak\Exception\PropertyDoesNotExistException;
use Fschmtt\Keycloak\Test\Unit\Stub\Representation;
use Fschmtt\Keycloak\Type\Map;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\Representation
 */
class RepresentationTest extends TestCase
{
    public function testThrowsExceptionWhenTryingToModifyPropertyWhichDoesNotExist(): void
    {
        $representation = new Representation();

        $this->expectException(PropertyDoesNotExistException::class);
        $representation->with('doesNotExist', 'value');
    }

    public function testThrowsExceptionWhenTryingToConstructFromJsonAndPropertyDoesNotExist(): void
    {
        $this->expectException(PropertyDoesNotExistException::class);
        Representation::fromJson(json_encode([
            'doesNotExist' => 'value',
        ], JSON_THROW_ON_ERROR));
    }

    public function testThrowsExceptionWhenTryingToConstructFromPropertiesAndPropertyDoesNotExist(): void
    {
        $this->expectException(PropertyDoesNotExistException::class);
        Representation::from([
            'doesNotExist' => 'value',
        ]);
    }

    public function testExistingPropertyCanBeModified(): void
    {
        $representation = new Representation();
        $modifiedRepresentation = $representation->withMap(
            new Map([
                'key' => 'value',
            ])
        );

        static::assertNull($representation->getMap());
        static::assertEquals(
            new Map([
                'key' => 'value',
            ]),
            $modifiedRepresentation->getMap(),
        );
        static::assertNotSame($representation, $modifiedRepresentation);
    }

    public function testCanBeConstructedFromJson(): void
    {
        $representation = Representation::fromJson(json_encode([
            'since2000' => 'since2000-value',
            'until1400' => 'until1400-value',
            'since1500Until1800' => 'since1500Until1800-value',
        ], JSON_THROW_ON_ERROR));

        static::assertSame($representation->getSince2000(), 'since2000-value');
        static::assertSame($representation->getUntil1400(), 'until1400-value');
        static::assertSame($representation->getSince1500Until1800(), 'since1500Until1800-value');
    }

    public function testCanBeConstructedFromPropertiesArray(): void
    {
        $representation = Representation::from([
            'since2000' => 'since2000-value',
            'until1400' => 'until1400-value',
            'since1500Until1800' => 'since1500Until1800-value',
        ]);

        static::assertSame($representation->getSince2000(), 'since2000-value');
        static::assertSame($representation->getUntil1400(), 'until1400-value');
        static::assertSame($representation->getSince1500Until1800(), 'since1500Until1800-value');
    }

    public function testJsonSerializesScalarTypesCorrectly(): void
    {
        $representation = Representation::from([
            'since2000' => 'since2000-value',
            'until1400' => 'until1400-value',
            'since1500Until1800' => 'since1500Until1800-value',
        ]);

        static::assertSame(
            [
                'since2000' => 'since2000-value',
                'until1400' => 'until1400-value',
                'since1500Until1800' => 'since1500Until1800-value',
                'map' => null,
            ],
            $representation->jsonSerialize()
        );
    }

    public function testJsonSerializesMapCorrectly(): void
    {
        $map = new Map([
            'key-1' => 'value-1',
            'key-2' => 'value-2',
            'key-3' => 'value-3',
        ]);

        $representation = Representation::from([
            'since2000' => 'since2000-value',
            'until1400' => 'until1400-value',
            'since1500Until1800' => 'since1500Until1800-value',
            'map' => $map,
        ]);

        $jsonSerialized = $representation->jsonSerialize();

        static::assertIsObject($jsonSerialized['map']);
    }

    public function testSerializesMapCorrectlyWhenOnlyArrayIsProvided(): void
    {
        $array = [
            'key-1' => 'value-1',
            'key-2' => 'value-2',
            'key-3' => 'value-3',
        ];

        $map = new Map($array);

        $representation = new Representation();
        $representation = $representation->with('map', [
            'key-1' => 'value-1',
            'key-2' => 'value-2',
            'key-3' => 'value-3',
        ]);

        static::assertInstanceOf(Map::class, $representation->getMap());
        static::assertEquals($map, $representation->getMap());
    }

    public function testThrowsIfPropertyDoesNotExist(): void
    {
        $representation = new Representation();

        $this->expectException(BadMethodCallException::class);

        $representation->doesNotExist();
    }
}
