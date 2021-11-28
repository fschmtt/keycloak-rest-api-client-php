<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Representation\ClientProfiles;

class ClientProfilesSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return ClientProfiles::class;
    }

    public function serialize($value): ClientProfiles
    {
        return ClientProfiles::from($value);
    }
}
