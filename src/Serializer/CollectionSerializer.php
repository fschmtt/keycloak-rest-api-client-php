<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Collection\Collection;
use Fschmtt\Keycloak\Representation\Representation;

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
        /** @var class-string<Representation> $representationClass */
        $representationClass = $type::getRepresentationClass();
        $representations = [];

        foreach ($value as $representation) {
            if ($representation instanceof $representationClass) {
                $representations[] = $representation;

                continue;
            }

            $representations[] = $representationClass::from($representation);
        }

        /** @psalm-suppress UndefinedClass */
        return new $type($representations);
    }
}
