<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method bool|null getBuiltin()
 * @method string|null getDescription()
 * @method array|null getExecutors()
 * @method string|null getName()
 * @method self withBuiltin(?bool $enable)
 * @method self withDescription(?array $description)
 * @method self withExecutors(?array $executors)
 * @method self withName(?string $name)
 *
 * @codeCoverageIgnore
 */
class ClientProfile extends Representation
{
    public function __construct(
        protected ?bool $builtin = null,
        protected ?string $description = null,
        protected ?array $executors = null,
        protected ?string $name = null,
    ) {
        parent::__construct(
            $builtin,
            $description,
            $executors,
            $name,
        );
    }
}
