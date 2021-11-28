<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Representation\ClientPolicies;

class ClientPoliciesSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return ClientPolicies::class;
    }

    public function serialize($value): ClientPolicies
    {
        return ClientPolicies::from($value);
    }
}
