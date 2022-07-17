<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Type;

class Map extends Type implements \Countable, \IteratorAggregate
{
    private array $map;

    public function __construct(array $map = [])
    {
        $this->map = $map;
    }

    public function jsonSerialize(): array
    {
        return (object) $this->map;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->map);
    }

    public function count(): int
    {
        return \count($this->map);
    }
}
