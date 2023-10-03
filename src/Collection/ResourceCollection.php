<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Resource;

/**
 * @extends Collection<Resource>
 *
 * @codeCoverageIgnore
 */
class ResourceCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Resource::class;
    }
}
