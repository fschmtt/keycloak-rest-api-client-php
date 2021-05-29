<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Type;

class Map extends Type
{
    private array $map;

    public function __construct(array $map = [])
    {
        $this->map = $map;
    }

    public function jsonSerialize()
    {
        return (object) $this->map;
    }
}
