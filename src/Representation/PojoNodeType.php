<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class PojoNodeType
{
    public function __toString(): string
    {
        return 'POJO';
    }
}
