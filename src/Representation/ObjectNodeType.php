<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class ObjectNodeType
{
    public function __toString(): string
    {
        return 'OBJECT';
    }
}
