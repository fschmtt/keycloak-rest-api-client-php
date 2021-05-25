<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class Roles extends Representation
{
    public function __construct(
        protected ?array $client,
        protected ?array $realm
    ) {
        parent::__construct(
            $client,
            $realm
        );
    }
}
