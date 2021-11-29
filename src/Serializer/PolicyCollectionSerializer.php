<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Collection\PolicyCollection;
use Fschmtt\Keycloak\Representation\Policy;

class PolicyCollectionSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return PolicyCollection::class;
    }

    public function serialize($value): PolicyCollection
    {
        $policies = [];

        foreach ($value as $policy) {
            $policies[] = Policy::from($policy);
        }

        return new PolicyCollection($policies);
    }
}
