<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Representation\Group;

class GroupCollectionSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return GroupCollection::class;
    }

    public function serialize($value): GroupCollection
    {
        $groups = [];

        foreach ($value as $group) {
            $groups[] = Group::from($group);
        }

        return new GroupCollection($groups);
    }
}
