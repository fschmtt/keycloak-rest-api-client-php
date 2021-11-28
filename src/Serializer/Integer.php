<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

class Integer implements SerializerInterface
{
    public function serializes(): string
    {
        return 'int';
    }

    public function serialize($value): int
    {
        return (int) $value;
    }
}
