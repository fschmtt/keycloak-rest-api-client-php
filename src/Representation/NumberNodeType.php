<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class NumberNodeType
{
    public function __toString(): string
    {
        return 'NUMBER';
    }
}
