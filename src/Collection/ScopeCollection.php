<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Scope;

/**
 * @codeCoverageIgnore
 */
class ScopeCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Scope::class;
    }
}
