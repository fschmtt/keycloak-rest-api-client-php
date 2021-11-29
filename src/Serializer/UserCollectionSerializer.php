<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Representation\User;

class UserCollectionSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return UserCollection::class;
    }

    public function serialize($value): UserCollection
    {
        $users = [];

        foreach ($value as $user) {
            $users[] = User::from($user);
        }

        return new UserCollection($users);
    }
}
