<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Collection\PasswordPolicyTypeCollection;
use Fschmtt\Keycloak\Representation\PasswordPolicyType;

class PasswordPolicyTypeCollectionSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return PasswordPolicyTypeCollection::class;
    }

    public function serialize($value): PasswordPolicyTypeCollection
    {
        $passwordPolicyTypes = [];

        foreach ($value as $passwordPolicyType) {
            $passwordPolicyTypes[] = PasswordPolicyType::from($passwordPolicyType);
        }

        return new PasswordPolicyTypeCollection($passwordPolicyTypes);
    }
}
