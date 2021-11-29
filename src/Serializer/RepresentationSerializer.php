<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Representation\Representation;

class RepresentationSerializer
{
    public function serializes(): string
    {
        return Representation::class;
    }

    public function serialize($type, $value): Representation
    {
        return $type::from($value);
    }
}
