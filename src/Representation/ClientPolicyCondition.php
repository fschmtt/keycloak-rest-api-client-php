<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @method string|null getCondition()
 * @method JsonNode|null getConfiguration()
 * @method self withCondition(?string $condition)
 * @method self withConfiguration(?JsonNode $configuration)
 */
#[IgnoreClassForCodeCoverage(self::class)]
class ClientPolicyCondition extends Representation
{
    public function __construct(
        protected ?string $condition = null,
        protected ?JsonNode $configuration = null,
    ) {
    }
}
