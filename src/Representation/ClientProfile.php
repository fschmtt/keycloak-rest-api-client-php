<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ClientPolicyExecutorCollection;

/**
 * @method bool|null getBuiltin()
 * @method self withBuiltin(?bool $enable)
 *
 * @method string|null getDescription()
 * @method self withDescription(?string $description)
 *
 * @method ClientPolicyExecutorCollection|null getExecutors()
 * @method self withExecutors(?ClientPolicyExecutorCollection $executors)
 *
 * @method string|null getName()
 * @method self withName(?string $name)
 *
 * @codeCoverageIgnore
 */
class ClientProfile extends Representation
{
    public function __construct(
        protected ?bool $builtin = null,
        protected ?string $description = null,
        protected ?ClientPolicyExecutorCollection $executors = null,
        protected ?string $name = null,
    ) {}
}
