<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Realm;

/**
 * @extends Collection<Realm>
 * @codeCoverageIgnore
 */
class RealmCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Realm::class;
    }
}
