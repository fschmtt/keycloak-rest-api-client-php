<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\UserFederationProvider;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<UserFederationProvider>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class UserFederationProviderCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return UserFederationProvider::class;
    }
}
