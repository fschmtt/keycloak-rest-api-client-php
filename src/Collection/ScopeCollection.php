<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Scope;

/**
 * @method Scope[] getIterator()
 * @codeCoverageIgnore
 */
class ScopeCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Scope::class;
    }
}
