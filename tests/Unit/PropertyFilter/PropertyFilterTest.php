<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\PropertyFilter;

use Fschmtt\Keycloak\PropertyFilter\PropertyFilter;
use Fschmtt\Keycloak\Test\Unit\Stub\Representation;
use Generator;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @covers \Fschmtt\Keycloak\PropertyFilter\PropertyFilter
 */
class PropertyFilterTest extends TestCase
{
    public function testDoesNotFilterPropertiesIfVersionIsNotProvided(): void
    {
        $representation = new Representation();
        $propertyFilter = new PropertyFilter();

        $filteredProperties = $propertyFilter->filter($representation);

        static::assertArrayHasKey('since2000', $filteredProperties);
        static::assertArrayHasKey('until1400', $filteredProperties);
        static::assertArrayHasKey('since1500Until1800', $filteredProperties);
    }

    /**
     * @dataProvider keycloakVersions
     */
    public function testFiltersOutPropertyWhichHasNotYetBeenIntroduced(string $version): void
    {
        $representation = new Representation();
        $propertyFilter = new PropertyFilter($version);

        if ((int) $version < 20) {
            static::assertArrayNotHasKey('since2000', $propertyFilter->filter($representation));
        } else {
            static::assertArrayHasKey('since2000', $propertyFilter->filter($representation));
        }
    }

    /**
     * @dataProvider keycloakVersions
     */
    public function testFiltersOutPropertyWhichHasBeenRemoved(string $version): void
    {
        $representation = new Representation();
        $propertyFilter = new PropertyFilter($version);

        if ((int) $version > 14) {
            static::assertArrayNotHasKey('until1400', $propertyFilter->filter($representation));
        } else {
            static::assertArrayHasKey('until1400', $propertyFilter->filter($representation));
        }
    }

    /**
     * @dataProvider keycloakVersions
     */
    public function testFiltersOutPropertyWhichHasBeenIntroducedAndRemoved(string $version): void
    {
        $representation = new Representation();
        $propertyFilter = new PropertyFilter($version);

        if ((int) $version < 15 || (int) $version > 18) {
            static::assertArrayNotHasKey('since1500Until1800', $propertyFilter->filter($representation));
        } else {
            static::assertArrayHasKey('since1500Until1800', $propertyFilter->filter($representation));
        }
    }

    public function testMemoizesFilteredPropertiesOfRepresentation(): void
    {
        $representation = new Representation();
        $propertyFilter = new PropertyFilter('20.0.0');

        $reflection = new ReflectionClass($propertyFilter);
        $reflection->getProperty('filteredProperties')->setAccessible(true);

        $memoizedFilteredProperties = $reflection->getProperty('filteredProperties')->getValue($propertyFilter);
        static::assertArrayNotHasKey($representation::class, $memoizedFilteredProperties);

        $propertyFilter->filter($representation);
        $propertyFilter->filter($representation);

        $memoizedFilteredProperties = $reflection->getProperty('filteredProperties')->getValue($propertyFilter);
        static::assertArrayHasKey($representation::class, $memoizedFilteredProperties);
    }

    public function keycloakVersions(): Generator
    {
        yield ['13.0.0'];
        yield ['14.0.0'];
        yield ['15.0.0'];
        yield ['16.0.0'];
        yield ['17.0.0'];
        yield ['18.0.0'];
        yield ['19.0.0'];
        yield ['20.0.0'];
    }
}
