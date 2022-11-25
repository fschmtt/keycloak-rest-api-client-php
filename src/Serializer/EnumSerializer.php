<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use BackedEnum;
use Fschmtt\Keycloak\Enum\Enum;

class EnumSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return Enum::class;
    }

    /**
     * @param BackedEnum $type
     */
    public function serialize(string $type, mixed $value): BackedEnum
    {
        return $type::from(strtoupper($value));
    }
}
