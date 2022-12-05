<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Type;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;
use function count;

class Map extends Type implements Countable, IteratorAggregate
{
    public function __construct(
        private readonly array $map = []
    ) {
    }

    public function jsonSerialize(): object
    {
        return (object) $this->map;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->map);
    }

    public function count(): int
    {
        return count($this->map);
    }
}
