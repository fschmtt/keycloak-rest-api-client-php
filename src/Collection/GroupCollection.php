<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Group;

/**
 * @method Group[] getIterator()
 * @codeCoverageIgnore
 */
class GroupCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Group::class;
    }
}
