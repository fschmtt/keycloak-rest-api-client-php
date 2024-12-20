<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string|null getAuthenticator()
 * @method self withAuthenticator(?string $authenticator)
 *
 * @method string|null getAuthenticatorConfig()
 * @method self withAuthenticatorConfig(?string $authenticatorConfig)
 *
 * @method bool|null getAuthenticatorFlow()
 * @method self withAuthenticatorFlow(?bool $authenticatorFlow)
 *
 * @method string|null getFlowId()
 * @method self withFlowId(?string $flowId)
 *
 * @method string|null getId()
 * @method self withId(?string $id)
 *
 * @method string|null getParentFlow()
 * @method self withParentFlow(?string $parentFlow)
 *
 * @method int|null getPriority()
 * @method self withPriority(?int $priority)
 *
 * @method string|null getRequirement()
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
