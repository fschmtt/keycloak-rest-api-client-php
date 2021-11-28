<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

class Boolean implements SerializerInterface
{
    public function serializes(): string
    {
        return 'bool';
    }

    public function serialize($value): bool
    {
        return (bool) $value;
    }
}
