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
        protected ?string $displayName,
        protected ?string $iconUri,
        protected ?string $id,
        protected ?string $name,
        protected ?PolicyCollection $policies,
        protected ?ResourceCollection $resources,
    ) {
        parent::__construct(
            $this->displayName,
            $this->iconUri,
            $this->id,
            $this->name,
            $this->policies,
            $this->resources,
        );
    }
}
