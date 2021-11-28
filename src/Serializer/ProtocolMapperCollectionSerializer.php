<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Collection\ProtocolMapperCollection;
use Fschmtt\Keycloak\Representation\ProtocolMapper;

class ProtocolMapperCollectionSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return ProtocolMapperCollection::class;
    }

    public function serialize($value): ProtocolMapperCollection
    {
        $protocolMappers = [];

        foreach ($value as $group) {
            $protocolMappers[] = ProtocolMapper::from($group);
        }

        return new ProtocolMapperCollection($protocolMappers);
    }
}
