<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\PolicyCollection;
use Fschmtt\Keycloak\Collection\ResourceCollection;

/**
 * @codeCoverageIgnore
 */
class Scope extends Representation
{
    public function __construct(
        protected ?string $displayName = null,
        protected ?string $iconUri = null,
        protected ?string $id = null,
        protected ?string $name = null,
        protected ?PolicyCollection $policies = null,
        protected ?ResourceCollection $resources = null,
    ) {}
}
