<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

class String implements SerializerInterface
{
    public function serializes(): string
    {
        return 'string';
    }

    public function serialize($value): string
    {
        return (string) $value;
    }
}