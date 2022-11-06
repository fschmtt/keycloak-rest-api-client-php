<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\PropertyFilter;

use Fschmtt\Keycloak\Representation\Realm;

class RealmPropertyFilter implements PropertyFilterInterface
{
    public function filters(string $representation): bool
    {
        return $representation === Realm::class;
    }

    public function filter(array $properties, string $version): array
    {
        if ((int) $version < 20) {
            unset($properties['otpPolicyCodeReusable']);
        }

        return $properties;
    }
}
