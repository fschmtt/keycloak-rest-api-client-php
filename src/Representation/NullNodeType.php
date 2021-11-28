<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class NullNodeType
{
    public function __toString(): string
    {
        return 'NULL';
    }
}
