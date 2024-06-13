<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

/**
 * @internal
 */
interface SerializerInterface
{
    public function serializes(): string;

    public function serialize(string $type, mixed $value): mixed;
}
