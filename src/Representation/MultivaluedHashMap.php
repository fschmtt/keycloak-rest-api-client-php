<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

#[IgnoreClassForCodeCoverage(self::class)]
class MultivaluedHashMap extends Representation
{
    public function __construct(
        protected bool $empty,
        protected float $loadFactor,
        protected int $threshold,
    ) {
    }
}
