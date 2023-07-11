<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ClientScope;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<ClientScope>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class ClientScopeCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ClientScope::class;
    }
}
