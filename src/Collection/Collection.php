<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Representation;

abstract class Collection implements \Countable, \IteratorAggregate
{
    protected array $items = [];

    public function __construct(iterable $items)
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    abstract public function getRepresentationClass(): string;

    public function count(): int
    {
        return \count($this->items);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    public function add(Representation $item): void
    {
        $expectedRepresentationClass = $this->getRepresentationClass();

        if (!$item instanceof $expectedRepresentationClass) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s expects items to be class %s, %s given',
                    static::class,
                    $expectedRepresentationClass,
                    get_class($item)
                )
            );
        }

        $this->items[] = $item;
    }
}
