<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Policy;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<Policy>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class PolicyCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Policy::class;
    }
}
