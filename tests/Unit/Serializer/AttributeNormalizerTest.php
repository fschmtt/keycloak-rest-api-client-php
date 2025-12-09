<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Representation\Representation;
use Fschmtt\Keycloak\Serializer\AttributeNormalizer;
use Fschmtt\Keycloak\Test\Unit\Stub\Representation as StubRepresentation;
use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use stdClass;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

#[CoversClass(AttributeNormalizer::class)]
class AttributeNormalizerTest extends TestCase
{
    public function testSupportsRepresentation(): void
    {
        $normalizer = new AttributeNormalizer(new PropertyNormalizer());

        static::assertSame(
            [Representation::class => true],
            $normalizer->getSupportedTypes(null),
        );

        static::assertTrue($normalizer->supportsNormalization(new StubRepresentation()));

        static::assertFalse($normalizer->supportsNormalization(new stdClass()));
    }

    public function testDoesNotFilterPropertiesIfVersionIsNotProvided(): void
    {
        $representation = new StubRepresentation();
        $normalizer = new AttributeNormalizer(new PropertyNormalizer(), null);

        $filteredProperties = $normalizer->normalize($representation);

        static::assertIsArray($filteredProperties);
        static::assertArrayHasKey('since2000', $filteredProperties);
        static::assertArrayHasKey('until1400', $filteredProperties);
        static::assertArrayHasKey('since1500Until1800', $filteredProperties);
    }

    #[DataProvider('supportedKeycloakVersions')]
    public function testFiltersOutPropertyWhichHasNotYetBeenIntroduced(string $version): void
    {
        $representation = new StubRepresentation();
        $normalizer = new AttributeNormalizer(new PropertyNormalizer(), $version);

        $filteredProperties = $normalizer->normalize($representation);
        static::assertIsArray($filteredProperties);

        if ((int) $version < 20) {
            static::assertArrayNotHasKey('since2000', $filteredProperties);
        } else {
            static::assertArrayHasKey('since2000', $filteredProperties);
        }
    }

    #[DataProvider('supportedKeycloakVersions')]
    public function testFiltersOutPropertyWhichHasBeenRemoved(string $version): void
    {
        $representation = new StubRepresentation();
        $normalizer = new AttributeNormalizer(new PropertyNormalizer(), $version);

        $filteredProperties = $normalizer->normalize($representation);
        static::assertIsArray($filteredProperties);

        if ((int) $version > 14) {
            static::assertArrayNotHasKey('until1400', $filteredProperties);
        } else {
            static::assertArrayHasKey('until1400', $filteredProperties);
        }
    }

    #[DataProvider('supportedKeycloakVersions')]
    public function testFiltersOutPropertyWhichHasBeenIntroducedAndRemoved(string $version): void
    {
        $representation = new StubRepresentation();
        $normalizer = new AttributeNormalizer(new PropertyNormalizer(), $version);

        $filteredProperties = $normalizer->normalize($representation);
        static::assertIsArray($filteredProperties);

        if ((int) $version < 15 || (int) $version > 18) {
            static::assertArrayNotHasKey('since1500Until1800', $filteredProperties);
        } else {
            static::assertArrayHasKey('since1500Until1800', $filteredProperties);
        }
    }

    public function testMemoizesFilteredPropertiesOfRepresentation(): void
    {
        $representation = new StubRepresentation();
        $normalizer = new AttributeNormalizer(new PropertyNormalizer(), '20.0.0');

        $reflection = new ReflectionClass($normalizer);

        $memoizedFilteredProperties = $reflection->getProperty('filteredProperties')->getValue($normalizer);
        static::assertArrayNotHasKey($representation::class, $memoizedFilteredProperties);

        $normalizer->normalize($representation);
        $normalizer->normalize($representation);

        $memoizedFilteredProperties = $reflection->getProperty('filteredProperties')->getValue($normalizer);
        static::assertArrayHasKey($representation::class, $memoizedFilteredProperties);
    }

    public static function supportedKeycloakVersions(): Generator
    {
        yield ['24.0.0'];
        yield ['25.0.0'];
        yield ['26.0.0'];
    }
}
