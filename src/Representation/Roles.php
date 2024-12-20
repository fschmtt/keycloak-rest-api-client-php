<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\RealmCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getApplication()
 * @method self withApplication(?Map $value)
 *
 * @method Map|null getClient()
 * @method self withClient(?Map $value)
 *
 * @method RealmCollection|null getRealm()
 * @method self withRealm(?RealmCollection $value)
 *
 * @codeCoverageIgnore
 */
class Roles extends Representation
{
    public function __construct(
        protected ?Map $application = null,
        protected ?Map $client = null,
        protected ?RealmCollection $realm = null,
    ) {}
}
