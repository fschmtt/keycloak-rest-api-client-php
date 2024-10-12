<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use ArrayObject;
use Fschmtt\Keycloak\Type\Map;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MapNormalizer implements NormalizerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function normalize(mixed $object, ?string $format = null, array $context = []): ArrayObject
    {
        return new ArrayObject($object);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Map;
    }

    /**
     * @return array<class-string|'*'|'object'|string, bool|null>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            Map::class => true,
        ];
    }
}
