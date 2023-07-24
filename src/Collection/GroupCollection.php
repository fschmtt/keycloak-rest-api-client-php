<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Group;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<Group>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class GroupCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Group::class;
    }
}
