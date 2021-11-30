<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

class BooleanSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return 'bool';
    }

    public function serialize(string $type, mixed $value): bool
    {
        if (is_string($value)) {
            $value = trim($value);
        }

        if ($value === 'false') {
            return false;
        }

        return boolval($value);
    }
}
