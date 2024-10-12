<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @codeCoverageIgnore
 */
class MultivaluedHashMap extends Representation
{
    public function __construct(
        protected ?bool $empty = null,
        protected ?float $loadFactor = null,
        protected ?int $threshold = null,
    ) {}
}
