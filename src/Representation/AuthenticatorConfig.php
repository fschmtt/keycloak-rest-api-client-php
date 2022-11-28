<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method string|null getAlias()
 * @method Map|null getConfig()
 * @method string|null getId()
 * @method self withAlias(?string $alias)
 * @method self withConfig(?Map $config)
 * @method self withId(?string $id)
 *
 * @codeCoverageIgnore
 */
class AuthenticatorConfig extends Representation
{
    public function __construct(
        ?string $alias = null,
        ?Map $config = null,
        ?string $id = null,
    ) {
        parent::__construct(
            $alias,
            $config,
            $id,
        );
    }
}
