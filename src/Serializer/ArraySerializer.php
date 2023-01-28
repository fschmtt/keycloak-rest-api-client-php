<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

class ArraySerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return 'array';
    }

    /**
     * @return array<mixed>
     */
    public function serialize(string $type, mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        return (array) $value;
    }
}
