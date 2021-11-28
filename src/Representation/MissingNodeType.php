<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class MissingNodeType
{
    public function __toString(): string
    {
        return 'MISSING';
    }
}
