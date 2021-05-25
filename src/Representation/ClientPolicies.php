<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method ClientPolicy[]|null getPolicies()
 * @method self withPolicies(?array $policies)
 */
class ClientPolicies extends Representation
{
    public function __construct(
        protected ?array $policies = null
    ) {
        parent::__construct($policies);
    }
}
