<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Enum\Logic;

class LogicSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return Logic::class;
    }

    public function serialize($value): Logic
    {
        return Logic::from($value);
    }
}
