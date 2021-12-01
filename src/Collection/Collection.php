<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use ArrayIterator;
use Countable;
use Fschmtt\Keycloak\Representation\Representation;
use InvalidArgumentException;
use IteratorAggregate;
use JsonSerializable;
use Traversable;
use function count;

abstract class Collection implements Countable, IteratorAggregate, JsonSerializable
{
    protected array $items = [];

    public function __construct(iterable $items)
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    abstract public static function getRepresentationClass(): string;

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }

    public function add(Representation $item): void
    {
        $expectedRepresentationClass = $this->getRepresentationClass();

        if (!$item instanceof $expectedRepresentationClass) {
            throw new InvalidArgumentException(
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
