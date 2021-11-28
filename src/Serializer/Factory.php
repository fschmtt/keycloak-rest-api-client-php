<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

class Factory
{
    public function create(): Serializer
    {
        return new Serializer(
            new ArraySerializer(),
            new BooleanSerializer(),
            new ClientCollectionSerializer(),
            new ClientPoliciesSerializer(),
            new ClientProfilesSerializer(),
            new GroupCollectionSerializer(),
            new IntegerSerializer(),
            new JsonNodeSerializer(),
            new MapSerializer(),
            new ProtocolMapperCollectionSerializer(),
            new RoleSerializer(),
            new StringSerializer(),
        );
    }
}
