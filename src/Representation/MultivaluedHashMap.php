<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class MultivaluedHashMap extends Representation
{
    public function __construct(
        protected bool $empty,
        protected float $loadFactor,
        protected int $threshold,
    ) {
    }
}
