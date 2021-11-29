<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

abstract class Enum implements \Stringable
{
    abstract public static function from(string $value): static;
}
