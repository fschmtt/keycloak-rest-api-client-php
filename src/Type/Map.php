<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Type;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use OutOfBoundsException;
use Traversable;

/**
 * @template T
 *
 * @implements IteratorAggregate<string, T>
 */
class Map extends Type implements Countable, IteratorAggregate
{
    /**
     * @param array<string, T> $map
     */
    public function __construct(
        private array $map = [],
    ) {}

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

    public function contains(string $key): bool
    {
        return array_key_exists($key, $this->map);
    }

    public function get(string $key): mixed
    {
        if (!$this->contains($key)) {
            throw new OutOfBoundsException(sprintf('Key "%s" does not exist in map', $key));
        }

        return $this->map[$key];
    }

    public function with(string $key, mixed $value): self
    {
        $clone = clone $this;

        $clone->map[$key] = $value;

        return $clone;
    }

    public function without(string $key): self
    {
        $clone = clone $this;

        unset($clone->map[$key]);

        return $clone;
    }

    /**
     * @return array<string, T>
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
