<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class Role extends Representation
{
    public function __construct(
        protected ?array $attributes = null,
        protected ?bool $clientRole = null,
        protected ?bool $composite = null,
        protected ?array $composites = null, // TODO RoleRepresentation-Composites https://www.keycloak.org/docs-api/13.0/rest-api/index.html#_rolerepresentation-composites
        protected ?string $containerId = null,
        protected ?string $description = null,
        protected ?string $id = null,
        protected ?string $name = null,
    ) {
        parent::__construct(
            $attributes,
            $clientRole,
            $composite,
            $containerId,
            $composites,
            $description,
            $id,
            $name,
        );
    }
}
