<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;

/**
 * @internal
 *
 * @codeCoverageIgnore
 */
class Serializer
{
    private readonly SymfonySerializer $serializer;

    public function __construct(
        ?string $keycloakVersion = null,
    ) {
        $classMetadataFactory = new ClassMetadataFactory(
            new AttributeLoader(),
        );

        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        $propertyNormalizer = new PropertyNormalizer(
            $classMetadataFactory,
            $metadataAwareNameConverter,
            defaultContext: [
                PropertyNormalizer::NORMALIZE_VISIBILITY => PropertyNormalizer::NORMALIZE_PROTECTED,
            ],
        );

        $this->serializer = new SymfonySerializer([
            new BackedEnumNormalizer(),
            new ArrayDenormalizer(),
            new CollectionDenormalizer($propertyNormalizer),
            new MapNormalizer(),
            new MapDenormalizer(),
            new AttributeNormalizer($propertyNormalizer, $keycloakVersion),
            $propertyNormalizer,
        ], [
            new JsonEncoder(),
        ]);
    }

    public function serialize(mixed $data): ?string
    {
        return $data === null ? null : $this->serializer->serialize($data, 'json');
    }

    public function deserialize(string $type, mixed $data): mixed
    {
        return $this->serializer->deserialize($data, $type, 'json');
    }
}
