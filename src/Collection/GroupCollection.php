<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Group;

/**
 * @method Group[] getIterator()
 */
class GroupCollection extends Collection
{
    public function getRepresentationClass(): string
    {
        return Group::class;
    }
}
