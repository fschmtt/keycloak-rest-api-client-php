<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Type\Map as MapType;

use function is_array;

class Map implements SerializerInterface
{
    public function serializes(): string
    {
        return MapType::class;
    }

    public function serialize($value): MapType
    {
        if (!is_array($value) || empty($value)) {
            return new MapType();
        }

        return new MapType($value);
    }
}
