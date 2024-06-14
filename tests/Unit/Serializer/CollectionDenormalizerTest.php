<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Collection\ClientCollection;
use Fschmtt\Keycloak\Collection\Collection;
use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Representation\Group;
use Fschmtt\Keycloak\Serializer\CollectionDenormalizer;
use Fschmtt\Keycloak\Serializer\CollectionSerializer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

#[CoversClass(CollectionDenormalizer::class)]
class CollectionDenormalizerTest extends TestCase
{
    public function testSupportedTypes(): void
    {
        $denormalizer = new CollectionDenormalizer(new PropertyNormalizer());

        static::assertSame(
            [Collection::class => true],
            $denormalizer->getSupportedTypes('json'),
        );
    }

    public function testSupportsDenormalization(): void
    {
        $denormalizer = new CollectionDenormalizer(new PropertyNormalizer());

        static::assertTrue($denormalizer->supportsDenormalization([], ClientCollection::class));
        static::assertFalse($denormalizer->supportsDenormalization([], 'array'));
    }

    public function testSerializesCollection(): void
    {
        $denormalizer = new CollectionDenormalizer(new PropertyNormalizer());

        $groupCollection = $denormalizer->denormalize(
            [new Group(), new Group()],
            GroupCollection::class,
        );

        static::assertInstanceOf(GroupCollection::class, $groupCollection);
        static::assertCount(2, $groupCollection);
    }
}
