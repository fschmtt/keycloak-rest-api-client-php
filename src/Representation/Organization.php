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
 * @method self withId(?string $id)
 *
 * @method string|null getName()
 * @method self withName(?string $name)
 *
 * @method bool|null getEnabled()
 * @method self withEnabled(?bool $enabled)
 *
 * @method string|null getDescription()
 * @method self withDescription(?string $description)
 *
 * @method Map|null getAttributes()
 * @method self withAttributes(?Map $attributes)
 *
 * @method OrganizationDomainCollection|null getDomains()
 * @method self withDomains(?OrganizationDomainCollection $domains)
 *
 * @method UserCollection|null getMembers()
 * @method self withMembers(?UserCollection $members)
 *
 * @method IdentityProviderCollection|null getIdentityProviders()
 * @method self withIdentityProviders(?IdentityProviderCollection $identityProviders)
 *
 * @method string|null getAlias()
 * @method self withAlias(?string $alias)
 *
 * @method string|null getRedirectUrl()
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
