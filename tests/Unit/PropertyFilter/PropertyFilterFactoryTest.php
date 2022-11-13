<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\PropertyFilter;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\PropertyFilter\PropertyFilterFactory
 */
class PropertyFilterFactoryTest extends TestCase
{
    public function testCreatesPropertyFilterWithRegisteredFilters(): void
    {
        $propertyFilter = (new PropertyFilterFactory())->create('20.0.0');

        static::assertInstanceOf(PropertyFilter::class, $propertyFilter);
    }
}
