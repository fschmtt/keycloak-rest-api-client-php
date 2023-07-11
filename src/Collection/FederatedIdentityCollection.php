<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\FederatedIdentity;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<FederatedIdentity>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class FederatedIdentityCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return FederatedIdentity::class;
    }
}
