<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getClient()
 * @method RealmCollection|null getRealm()
 * @method self withClient(?Map $client)
 * @method self withRealm(?RealmCollection $realm)
 *
 * @codeCoverageIgnore
 */
class RoleComposites extends Representation
{
    public function __construct(
        protected ?Map $client = null,
        protected ?RealmCollection $realm = null
    ) {
    }
}
