<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method ClientPolicy[]|null getPolicies()
 * @method self withPolicies(?array $policies)
 *
 * @codeCoverageIgnore
 */
class ClientPolicies extends Representation
{
    public function __construct(
        protected ?array $policies = null
    ) {
    }
}
