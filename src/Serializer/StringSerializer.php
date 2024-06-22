<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

/**
 * @internal
 */
class StringSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return 'string';
    }

    public function serialize(string $type, mixed $value): string
    {
        return (string) $value;
    }
}
