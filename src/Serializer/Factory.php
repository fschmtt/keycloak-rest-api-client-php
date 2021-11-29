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
            new LogicSerializer(),
            new MapSerializer(),
            new PasswordPolicyTypeCollectionSerializer(),
            new PolicyCollectionSerializer(),
            new PolicyEnforcementModeSerializer(),
            new ProtocolMapperCollectionSerializer(),
            new ResourceCollectionSerializer(),
            new RoleSerializer(),
            new StringSerializer(),
            new UserCollectionSerializer(),
        );
    }
}
