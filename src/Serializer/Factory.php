<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

class Factory
{
    public function create(): Serializer
    {
        return new Serializer(
            new ArraySerializer(),
            new BooleanSerializer(),
            new IntegerSerializer(),
            new JsonNodeSerializer(),
            new MapSerializer(),
            new StringSerializer(),
        );
    }
}
