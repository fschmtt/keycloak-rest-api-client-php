<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getConfig()
 * @method self withConfig(?Map $config)
 *
 * @method string|null getId()
 * @method self withId(?string $id)
 *
 * @method string|null getIdentityProviderAlias()
 * @method self withIdentityProviderAlias(?string $identityProviderAlias)
 *
 * @method string|null getIdentityProviderMapper()
 * @method self withIdentityProviderMapper(?string $identityProviderMapper)
 *
 * @method string|null getName()
 * @method self withName(?string $name)
 *
 * @codeCoverageIgnore
 */
class IdentityProviderMapper extends Representation
{
    public function __construct(
        protected ?Map $config = null,
        protected ?string $id = null,
        protected ?string $identityProviderAlias = null,
        protected ?string $identityProviderMapper = null,
        protected ?string $name = null,
    ) {}
}
