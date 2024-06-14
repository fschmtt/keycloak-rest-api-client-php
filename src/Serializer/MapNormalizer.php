<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Representation\Representation;
use Fschmtt\Keycloak\Type\Map;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MapNormalizer implements NormalizerInterface
{
    public function normalize(mixed $object, ?string $format = null, array $context = []): \ArrayObject
    {
        return new \ArrayObject($object);
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Map;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            Map::class => true,
        ];
    }
}
