<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\AuthenticationFlow;

/**
 * @codeCoverageIgnore
 * @extends Collection<AuthenticationFlow>
 */
class AuthenticationFlowCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return AuthenticationFlow::class;
    }
}
