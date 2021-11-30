<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

class IntegerSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return 'int';
    }

    public function serialize(string $type, mixed $value): int
    {
        return intval($value);
    }
}
