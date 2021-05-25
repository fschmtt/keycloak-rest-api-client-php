<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Type;

use stdClass;

class Map extends Type
{
    private array $map;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public function jsonSerialize()
    {
        if (count($this->map) < 1) {
            return new stdClass();
        }

        return $this->map;
    }
}
