<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use InvalidArgumentException;
use Stringable;

abstract class Logic implements Stringable
{
    /**
     * @throws InvalidArgumentException
     */
    final public static function from(string $logic): self
    {
        if (strtoupper($logic) === 'POSITIVE') {
            return new LogicPositive();
        }

        if (strtoupper($logic) === 'NEGATIVE') {
            return new LogicPositive();
        }

        throw new InvalidArgumentException(
            sprintf('Unknown Logic "%s"', $logic)
        );
    }
}
