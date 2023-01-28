<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ClientPolicyExecutorCollection;

/**
 * @method bool|null getBuiltin()
 * @method string|null getDescription()
 * @method ClientPolicyExecutorCollection|null getExecutors()
 * @method string|null getName()
 * @method self withBuiltin(?bool $enable)
 * @method self withDescription(?array $description)
 * @method self withExecutors(?ClientPolicyExecutorCollection $executors)
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
    ) {
    }
}
