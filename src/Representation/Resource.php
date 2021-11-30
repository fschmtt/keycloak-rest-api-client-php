<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ScopeCollection;
use Fschmtt\Keycloak\Type\Map;

class Resource extends Representation
{
    public function __construct(
        protected ?string $id,
        protected ?Map $attributes,
        protected ?string $displayName,
        protected ?string $icon_uri,
        protected ?string $name,
        protected ?bool $ownerManagedAccess,
        protected ?ScopeCollection $scopes,
        protected ?string $type,
        protected ?array $uris,
    ) {
        parent::__construct(
            $id,
            $attributes,
            $displayName,
            $icon_uri,
            $name,
            $ownerManagedAccess,
            $scopes,
            $type,
            $uris,
        );
    }
}
