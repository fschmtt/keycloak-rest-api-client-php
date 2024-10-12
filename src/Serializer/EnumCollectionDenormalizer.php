<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Enum\EnumCollection;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class EnumCollectionDenormalizer implements DenormalizerInterface
{
    public function __construct(
        private readonly BackedEnumNormalizer $denormalizer,
    ) {}

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        /** @var EnumCollection $collection */
        $collection = new $type();

        foreach ($data as $enum) {
            $collection->add(
                $this->denormalizer->denormalize($enum, $collection::getEnumClass(), $format, $context),
            );
        }

        return $collection;
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return is_subclass_of($type, EnumCollection::class);
    }

    /**
     * @return array<class-string|'*'|'object'|string, bool|null>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            EnumCollection::class => true,
        ];
    }
}
