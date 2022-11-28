<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Collection\Collection;

class CollectionSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return Collection::class;
    }

    /**
     * @param class-string<Collection> $type
     */
    public function serialize(string $type, $value): Collection
    {
        $representationClass = $type::getRepresentationClass();
        $representations = [];

        foreach ($value as $representation) {
            $representations[] = $representationClass::from($representation);
        }

        /** @psalm-suppress UndefinedClass */
        return new $type($representations);
    }
}
