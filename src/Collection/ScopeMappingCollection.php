<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ScopeMapping;

/**
 * @codeCoverageIgnore
 * @extends Collection<ScopeMapping>
 */
class ScopeMappingCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ScopeMapping::class;
    }
}
