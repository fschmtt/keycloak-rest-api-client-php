<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class NodeTypeBinary extends NodeType
{
    public function __toString(): string
    {
        return 'BINARY';
    }
}
