<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class BinaryNodeType extends NodeType
{
    public function __toString(): string
    {
        return 'BINARY';
    }
}
