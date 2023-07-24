<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ScopeMapping;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<ScopeMapping>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class ScopeMappingCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ScopeMapping::class;
    }
}
