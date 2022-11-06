<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\PropertyFilter;

class PropertyFilterFactory
{
    public function create(string $version): PropertyFilter
    {
        return new PropertyFilter(
            $version,
            [
                new RealmPropertyFilter(),
            ]
        );
    }
}
