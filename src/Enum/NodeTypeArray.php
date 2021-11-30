<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class NodeTypeArray extends NodeType
{
    public function __toString(): string
    {
        return 'ARRAY';
    }
}
