<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method JsonNode|null getConfiguration()
 * @method string|null getExecutor()
 * @method self withConfiguration(?JsonNode $configuration)
 * @method self withExecutor(?string $executor)
 *
 * @codeCoverageIgnore
 */
class ClientPolicyExecutor extends Representation
{
    public function __construct(
        protected ?JsonNode $configuration = null,
        protected ?string $executor = null,
    ) {
    }
}
