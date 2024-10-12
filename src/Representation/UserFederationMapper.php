<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getConfig()
 * @method self withConfig(?Map $config)
 * @method string|null getFederationMapperType()
 * @method self withFederationMapperType(?string $federationMapperType)
 * @method string|null getFederationProviderDisplayName()
 * @method self withFederationProviderDisplayName(?string $federationProviderDisplayName)
 * @method string|null getId()
 * @method self withId(?string $id)
 * @method string|null getName()
 * @method self withName(?string $name)
 *
 * @codeCoverageIgnore
 */
class UserFederationMapper extends Representation
{
    public function __construct(
        protected ?Map $config = null,
        protected ?string $federationMapperType = null,
        protected ?string $federationProviderDisplayName = null,
        protected ?string $id = null,
        protected ?string $name = null,
    ) {}
}
