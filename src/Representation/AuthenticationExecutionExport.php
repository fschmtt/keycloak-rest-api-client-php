<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string|null getAuthenticator()
 * @method string|null getAuthenticatorConfig()
 * @method bool|null getAuthenticatorFlow()
 * @method string|null getFlowId()
 * @method string|null getId()
 * @method string|null getParentFlow()
 * @method int|null getPriority()
 * @method string|null getRequirement()
 * @method self withAuthenticator(?string $authenticator)
 * @method self withAuthenticatorConfig(?string $authenticatorConfig)
 * @method self withAuthenticatorFlow(?bool $authenticatorFlow)
 * @method self withFlowId(?string $flowId)
 * @method self withId(?string $id)
 * @method self withParentFlow(?string $parentFlow)
 * @method self withPriority(?int $priority)
 * @method self withRequirement(?string $requirement)
 *
 * @codeCoverageIgnore
 */
class AuthenticationExecutionExport extends Representation
{
    public function __construct(
        protected ?string $authenticator = null,
        protected ?string $authenticatorConfig = null,
        protected ?bool $authenticatorFlow = null,
        protected ?string $flowId = null,
        protected ?string $id = null,
        protected ?string $parentFlow = null,
        protected ?int $priority = null,
        protected ?string $requirement = null,
    ) {}
}
