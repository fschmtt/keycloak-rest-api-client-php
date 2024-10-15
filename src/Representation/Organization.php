<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Attribute\Since;
use Fschmtt\Keycloak\Collection\IdentityProviderCollection;
use Fschmtt\Keycloak\Collection\OrganizationDomainCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method string|null getId()
 * @method string|null getName()
 * @method bool|null getEnabled()
 * @method string|null getDescription()
 * @method Map|null getAttributes()
 * @method OrganizationDomainCollection|null getDomains()
 * @method UserCollection|null getMembers()
 * @method IdentityProviderCollection|null getIdentityProviders()
 * @method string|null getAlias()
 * @method string|null getRedirectUrl()
 * @method self withId(?string $id)
 * @method self withName(?string $name)
 * @method self withEnabled(?bool $enabled)
 * @method self withDescription(?string $description)
 * @method self withAttributes(?Map $attributes)
 * @method self withDomains(?OrganizationDomainCollection $domains)
 * @method self withMembers(?UserCollection $members)
 * @method self withIdentityProviders(?IdentityProviderCollection $identityProviders)
 * @method self withAlias(?string $alias)
 * @method self withRedirectUrl(?string $redirectUrl)
 *
 * @codeCoverageIgnore
 */
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
        #[Since('26.0.0')]
        protected ?string $alias = null,
        #[Since('26.0.0')]
        protected ?string $redirectUrl = null,
    ) {}
}
