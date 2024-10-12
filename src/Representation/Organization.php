<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\IdentityProviderCollection;
use Fschmtt\Keycloak\Collection\OrganizationDomainCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Type\Map;

class Organization extends Representation
{
    public function __construct(
        protected ?string $id = null,
        protected ?string $name = null,
        protected ?bool $enabled = null,
        protected ?string $description = null,
        protected ?Map $attributes = null,
        protected ?OrganizationDomainCollection $domains = null,
        protected ?UserCollection $members = null,
        protected ?IdentityProviderCollection $identityProviders = null,
    ) {}
}
