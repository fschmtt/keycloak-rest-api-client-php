<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Enum\Enum;

class EnumSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return Enum::class;
    }

    /**
     * @param Enum $type
     */
    public function serialize(string $type, mixed $value): Enum
    {
        return $type::from($value);
    }
}
