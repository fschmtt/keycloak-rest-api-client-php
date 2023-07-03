<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Realm;

/**
 * @codeCoverageIgnore
 * @extends Collection<Realm>
 */
class RealmCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Realm::class;
    }
}
