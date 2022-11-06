<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\PropertyFilter;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\PropertyFilter\PropertyFilter
 */
class PropertyFilterTest extends TestCase
{
    public function testDelegatesFilteringToRegisteredPropertyFilter(): void
    {
        $registeredPropertyFilterMock = $this->createMock(PropertyFilterInterface::class);
        $registeredPropertyFilterMock->expects(static::once())
            ->method('filters')
            ->with('representation')
            ->willReturn(true);
        $registeredPropertyFilterMock->expects(static::once())
            ->method('filter')
            ->with(['property' => 'value'], '20.0.0');

        $propertyFilter = new PropertyFilter(
            '20.0.0',
            [
                $registeredPropertyFilterMock
            ]
        );

        $propertyFilter->filter(['property' => 'value'], 'representation');
    }

    public function testReturnsUnfilteredPropertiesIfNoRegisteredFilterSupportsRepresentation(): void
    {
        $registeredPropertyFilterMock = $this->createMock(PropertyFilterInterface::class);
        $registeredPropertyFilterMock->expects(static::once())
            ->method('filters')
            ->with('representation')
            ->willReturn(false);
        $registeredPropertyFilterMock->expects(static::never())
            ->method('filter');

        $propertyFilter = new PropertyFilter(
            '20.0.0',
            [
                $registeredPropertyFilterMock
            ]
        );

        $propertyFilter->filter(['property' => 'value'], 'representation');
    }
}
