<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\PropertyFilter;

use Fschmtt\Keycloak\PropertyFilter\PropertyFilter;
use Fschmtt\Keycloak\PropertyFilter\PropertyFilterInterface;
use Fschmtt\Keycloak\Representation\Realm;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\PropertyFilter\PropertyFilter
 * @covers \Fschmtt\Keycloak\Representation\Realm
 */
class PropertyFilterTest extends TestCase
{
    public function testDelegatesFilteringToRegisteredPropertyFilter(): void
    {
        $registeredPropertyFilterMock = $this->createMock(PropertyFilterInterface::class);
        $registeredPropertyFilterMock->expects(static::once())
            ->method('filters')
            ->with(Realm::class)
            ->willReturn(true);
        $registeredPropertyFilterMock->expects(static::once())
            ->method('filter')
            ->with([
                'property' => 'value',
            ], '20.0.0');

        $propertyFilter = new PropertyFilter(
            '20.0.0',
            [
                $registeredPropertyFilterMock,
            ]
        );

        $propertyFilter->filter([
            'property' => 'value',
        ], Realm::class);
    }

    public function testReturnsUnfilteredPropertiesIfNoRegisteredFilterSupportsRepresentation(): void
    {
        $registeredPropertyFilterMock = $this->createMock(PropertyFilterInterface::class);
        $registeredPropertyFilterMock->expects(static::once())
            ->method('filters')
            ->with(Realm::class)
            ->willReturn(false);
        $registeredPropertyFilterMock->expects(static::never())
            ->method('filter');

        $propertyFilter = new PropertyFilter(
            '20.0.0',
            [
                $registeredPropertyFilterMock,
            ]
        );

        $propertyFilter->filter([
            'property' => 'value',
        ], Realm::class);
    }
}
