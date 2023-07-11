<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @method JsonNode|null getConfiguration()
 * @method string|null getExecutor()
 * @method self withConfiguration(?JsonNode $configuration)
 * @method self withExecutor(?string $executor)
 */
#[IgnoreClassForCodeCoverage(self::class)]
class ClientPolicyExecutor extends Representation
{
    public function __construct(
        protected ?JsonNode $configuration = null,
        protected ?string $executor = null,
    ) {
    }
}
