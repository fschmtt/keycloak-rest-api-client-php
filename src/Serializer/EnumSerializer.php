<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use BackedEnum;
use Fschmtt\Keycloak\Enum\Enum;

/**
 * @internal
 */
class EnumSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return Enum::class;
    }

    /**
     * @param class-string<BackedEnum> $type
     */
    public function serialize(string $type, mixed $value): BackedEnum
    {
        return $type::from(strtoupper($value));
    }
}
