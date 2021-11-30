<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Realm;

/**
 * @method Realm[] getIterator()
 */
class RealmCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Realm::class;
    }
}
