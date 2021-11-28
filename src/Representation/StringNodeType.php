<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class StringNodeType extends NodeType
{
    public function __toString(): string
    {
        return 'STRING';
    }
}
