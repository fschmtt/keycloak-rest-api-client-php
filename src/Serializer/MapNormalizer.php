<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use ArrayObject;
use Fschmtt\Keycloak\Type\Map;
use InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MapNormalizer implements NormalizerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function normalize(mixed $data, ?string $format = null, array $context = []): ArrayObject
    {
        if (!$data instanceof Map) {
            throw new InvalidArgumentException(sprintf('Data must be an instance of "%s"', Map::class));
        }

        return new ArrayObject($data->jsonSerialize());
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
