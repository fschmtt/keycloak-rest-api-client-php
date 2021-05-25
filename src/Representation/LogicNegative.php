<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class LogicNegative extends Logic
{
    public function __toString()
    {
        return 'NEGATIVE';
    }
}
