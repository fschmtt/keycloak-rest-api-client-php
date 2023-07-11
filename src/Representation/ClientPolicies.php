<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ClientPolicyCollection;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @method ClientPolicyCollection|null getPolicies()
 * @method self withPolicies(?ClientPolicyCollection $policies)
 */
#[IgnoreClassForCodeCoverage(self::class)]
class ClientPolicies extends Representation
{
    public function __construct(
        protected ?ClientPolicyCollection $policies = null
    ) {
    }
}
