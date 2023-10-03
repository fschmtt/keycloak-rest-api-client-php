<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string|null getCondition()
 * @method JsonNode|null getConfiguration()
 * @method self withCondition(?string $condition)
 * @method self withConfiguration(?JsonNode $configuration)
 *
 * @codeCoverageIgnore
 */
class ClientPolicyCondition extends Representation
{
    public function __construct(
        protected ?string $condition = null,
        protected ?JsonNode $configuration = null,
    ) {
    }
}
