<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class NodeTypePojo extends NodeType
{
    public function __toString(): string
    {
        return 'POJO';
    }
}
