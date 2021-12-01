<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use InvalidArgumentException;
use ReflectionClass;
use Stringable;
use UnhandledMatchError;

abstract class Enum implements Stringable
{
    final public static function from(string $value): static
    {
        try {
            return static::match($value);
        } catch (UnhandledMatchError) {
            throw new InvalidArgumentException(
                sprintf('Unknown %s "%s"', (new ReflectionClass(static::class))->getShortName(), $value)
            );
        }
    }

    abstract protected static function match(string $value): static;
}
