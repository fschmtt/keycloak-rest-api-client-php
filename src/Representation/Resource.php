<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ScopeCollection;
use Fschmtt\Keycloak\Type\Map;
use Symfony\Component\Serializer\Attribute\SerializedName;

/**
 * @codeCoverageIgnore
 */
class Resource extends Representation
{
    public function __construct(
        #[SerializedName('_id')]
        protected ?string $id = null,
        protected ?Map $attributes = null,
        protected ?string $displayName = null,
        protected ?string $icon_uri = null,
        protected ?string $name = null,
        protected ?bool $ownerManagedAccess = null,
        protected ?ScopeCollection $scopes = null,
        protected ?string $type = null,
        /** @var string[]|null */
        protected ?array $uris = null,
    ) {
    }
}
