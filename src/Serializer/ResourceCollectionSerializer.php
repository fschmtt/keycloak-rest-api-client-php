<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Collection\ResourceCollection;
use Fschmtt\Keycloak\Representation\Resource;

class ResourceCollectionSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return ResourceCollection::class;
    }

    public function serialize($value): ResourceCollection
    {
        $resources = [];

        foreach ($value as $resource) {
            $resources[] = Resource::from($resource);
        }

        return new ResourceCollection($resources);
    }
}
