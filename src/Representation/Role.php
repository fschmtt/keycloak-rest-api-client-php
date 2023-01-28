<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method array|null getAttributes()
 * @method bool|null getClientRole()
 * @method bool|null getComposite()
 * @method RoleComposites|null getComposites()
 * @method string|null getContainerId()
 * @method string|null getDescription()
 * @method string|null getName()
 *
 * @codeCoverageIgnore
 */
class Role extends Representation
{
    public function __construct(
        protected ?array $attributes = null,
        protected ?bool $clientRole = null,
        protected ?bool $composite = null,
        protected ?RoleComposites $composites = null,
        protected ?string $containerId = null,
        protected ?string $description = null,
        protected ?string $id = null,
        protected ?string $name = null,
    ) {
    }
}
