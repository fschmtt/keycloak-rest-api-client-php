<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

class Factory
{
    public function create(): Serializer
    {
        return new Serializer(
            // Native serializers
            new ArraySerializer(),
            new BooleanSerializer(),
            new IntegerSerializer(),
            new MapSerializer(),
            new StringSerializer(),
            // Collection serializer
            new CollectionSerializer(),
            // Representation serializer
            new RepresentationSerializer(),
            // Enum serializer
            new EnumSerializer(),
        );
    }
}
