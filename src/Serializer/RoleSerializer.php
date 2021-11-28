<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Representation\Role;

class RoleSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return Role::class;
    }

    public function serialize($value): Role
    {
        return Role::from($value);
    }
}
