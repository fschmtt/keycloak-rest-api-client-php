<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getClient()
 * @method self withClient(?Map $client)
 * @method string[]|null getRealm()
 * @method self withRealm(?array $realm)
 *
 * @codeCoverageIgnore
 */
class Roles extends Representation
{
    public function __construct(
        protected ?Map $client = null,
        /** @var string[]|null */
        protected ?array $realm = null,
    ) {
    }
}
