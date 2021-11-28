<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Type\Map;

use function is_array;

class MapSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return Map::class;
    }

    public function serialize($value): Map
    {
        if (!is_array($value) || empty($value)) {
            return new Map();
        }

        return new Map($value);
    }
}
