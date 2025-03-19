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
 * @method string|null getFlowAlias()
 * @method self withFlowAlias(?string $flowAlias)
 *
 * @method int|null getPriority()
 * @method self withPriority(?int $priority)
 *
 * @method string|null getRequirement()
 * @method self withRequirement(?string $requirement)
 *
 * @method bool|null getUserSetupAllowed()
 * @method self withUserSetupAllowed(?bool $userSetupAllowed)
 * @codeCoverageIgnore
 */
class AuthenticationExecutionExport extends Representation
{
    public function __construct(
        protected ?string $authenticator = null,
        protected ?string $authenticatorConfig = null,
        protected ?bool $authenticatorFlow = null,
        protected ?string $flowAlias = null,
        protected ?int $priority = null,
        protected ?string $requirement = null,
        protected ?bool $userSetupAllowed = null,
    ) {}
}
