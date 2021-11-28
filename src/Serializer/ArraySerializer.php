<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

class ArraySerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return 'array';
    }

    public function serialize($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        return (array) $value;
    }
}
