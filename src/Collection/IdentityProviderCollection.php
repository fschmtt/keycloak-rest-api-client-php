<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\IdentityProvider;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<IdentityProvider>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class IdentityProviderCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return IdentityProvider::class;
    }
}
