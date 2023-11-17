<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Feature;

/**
 * @extends Collection<Feature>
 *
 * @codeCoverageIgnore
 */
class FeatureCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Feature::class;
    }
}
