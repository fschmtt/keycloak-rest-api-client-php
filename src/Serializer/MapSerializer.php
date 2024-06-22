<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Type\Map;

/**
 * @internal
 */
class MapSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return Map::class;
    }

    public function serialize(string $type, mixed $value): Map
    {
        if ($value instanceof Map) {
            return $value;
        }

        if (!is_array($value) || empty($value)) {
            return new Map();
        }

        return new Map($value);
    }
}
