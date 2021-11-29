<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Collection\ScopeCollection;
use Fschmtt\Keycloak\Representation\Scope;

class ScopeCollectionSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return ScopeCollection::class;
    }

    public function serialize($value): ScopeCollection
    {
        $scopes = [];

        foreach ($value as $scope) {
            $scopes[] = Scope::from($scope);
        }

        return new ScopeCollection($scopes);
    }
}
