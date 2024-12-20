<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method string|null getAlias()
 * @method self withAlias(?string $alias)
 *
 * @method Map|null getConfig()
 * @method self withConfig(?Map $config)
 *
 * @method string|null getId()
 * @method self withId(?string $id)
 *
 * @codeCoverageIgnore
 */
class AuthenticatorConfig extends Representation
{
    public function __construct(
        protected ?string $alias = null,
        protected ?Map $config = null,
        protected ?string $id = null,
    ) {}
}
