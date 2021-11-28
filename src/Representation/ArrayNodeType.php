<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class ArrayNodeType
{
    public function __toString(): string
    {
        return 'ARRAY';
    }
}
