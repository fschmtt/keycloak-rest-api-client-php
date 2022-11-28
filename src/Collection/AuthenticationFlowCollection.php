<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\AuthenticationFlow;

/**
 * @method AuthenticationFlow[] getIterator()
 * @codeCoverageIgnore
 */
class AuthenticationFlowCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return AuthenticationFlow::class;
    }
}
