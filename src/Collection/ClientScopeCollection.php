<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ClientScope;

/**
 * @codeCoverageIgnore
 * @extends Collection<ClientScope>
 */
class ClientScopeCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ClientScope::class;
    }
}
