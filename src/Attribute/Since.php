<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Attribute;

use Attribute;

#[Attribute]
class Since
{
    public function __construct(
        public readonly string $version
    ) {
    }
}
