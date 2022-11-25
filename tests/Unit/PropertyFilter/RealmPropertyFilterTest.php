<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\PropertyFilter;

use Fschmtt\Keycloak\PropertyFilter\RealmPropertyFilter;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Resource\ServerInfo;
use Generator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\PropertyFilter\RealmPropertyFilter
 */
class RealmPropertyFilterTest extends TestCase
{
    private RealmPropertyFilter $propertyFilter;

    protected function setUp(): void
    {
        $this->propertyFilter = new RealmPropertyFilter();
    }

    public function testFiltersRealmRepresentation(): void
    {
        static::assertTrue($this->propertyFilter->filters(Realm::class));
    }

    public function testDoesNotFilterServerInfoRepresentation(): void
    {
        static::assertFalse($this->propertyFilter->filters(ServerInfo::class));
    }

    /**
     * @dataProvider keycloakVersions
     */
    public function testFiltersPropertiesPriorToVersion20(string $version): void
    {
        $properties = $this->propertyFilter->filter(
            [
                'otpPolicyCodeReusable' => true,
            ],
            $version
        );

        if ((int) $version < 20) {
            static::assertArrayNotHasKey('otpPolicyCodeReusable', $properties);
        } else {
            static::assertArrayHasKey('otpPolicyCodeReusable', $properties);
        }
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
