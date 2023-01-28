<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @codeCoverageIgnore
 */
class Roles extends Representation
{
    public function __construct(
        protected ?array $client = null,
        protected ?array $realm = null,
    ) {
    }
}
