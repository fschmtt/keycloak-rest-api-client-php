<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use JsonSerializable;
use ReflectionClass;
use ReflectionException;
use Traversable;

/**
 * @template T of Enum
 * @implements IteratorAggregate<T>
 */
abstract class EnumCollection implements Countable, IteratorAggregate, JsonSerializable
{
    /**
     * @var array<array-key, T>
     */
    protected array $items = [];

    /**
     * @param iterable<T> $items
     */
    public function __construct(iterable $items = [])
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * @return class-string<Enum>
     */
    abstract public static function getEnumClass(): string;

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @return array<array-key, T>
     */
    public function jsonSerialize(): array
    {
        return $this->items;
    }

    /**
     * @throws ReflectionException
     */
    public function add(Enum $item): void
    {
        $expectedEnumClass = $this->getEnumClass();

        if (!$item instanceof $expectedEnumClass) {
            throw new InvalidArgumentException(
                sprintf(
                    '%s expects items to be %s enum, %s given',
                    (new ReflectionClass(static::class))->getShortName(),
                    (new ReflectionClass($expectedEnumClass))->getShortName(),
                    (new ReflectionClass($item))->getShortName(),
                ),
            );
        }

        $this->items[] = $item;
    }

    /**
     * @return T
     */
    public function first(): ?Enum
    {
        return $this->items[0] ?? null;
    }
}
