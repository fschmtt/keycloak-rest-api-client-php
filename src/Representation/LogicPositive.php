<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class LogicPositive extends Logic
{
    public function __toString()
    {
        return 'POSITIVE';
    }
}
