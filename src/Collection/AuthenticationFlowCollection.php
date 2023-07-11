<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\AuthenticationFlow;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<AuthenticationFlow>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class AuthenticationFlowCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return AuthenticationFlow::class;
    }
}
