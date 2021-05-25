<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method bool|null getBuiltin()
 * @method string[]|null getConditions()
 * @method string|null getDescription()
 * @method bool|null getEnable()
 * @method string|null getName()
 * @method string[]|null getProfiles()
 * @method self withBuiltin(?bool $enable)
 * @method self withConditions(?array $conditions)
 * @method self withDescription(?array $description)
 * @method self withEnable(?bool $enable)
 * @method self withName(?string $name)
 * @method self withProfiles(?array $profiles)
 */
class ClientPolicy extends Representation
{
    public function __construct(
        protected ?bool $builtin = null,
        protected ?array $conditions = null,
        protected ?string $description = null,
        protected ?bool $enable = null,
        protected ?string $name = null,
        protected ?array $profiles = null,
    ) {
        parent::__construct(
            $builtin,
            $conditions,
            $description,
            $enable,
            $name,
            $profiles,
        );
    }
}
