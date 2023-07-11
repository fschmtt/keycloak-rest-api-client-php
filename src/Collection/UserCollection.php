<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\User;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<User>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class UserCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return User::class;
    }
}
