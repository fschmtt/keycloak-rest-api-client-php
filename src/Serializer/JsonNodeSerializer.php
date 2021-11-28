<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Representation\JsonNode;

class JsonNodeSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return JsonNode::class;
    }

    public function serialize($value): bool
    {
        return (bool) $value;
    }
}
