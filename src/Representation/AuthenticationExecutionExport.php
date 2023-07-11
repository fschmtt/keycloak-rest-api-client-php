<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

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
 */
#[IgnoreClassForCodeCoverage(self::class)]
class AuthenticationExecutionExport extends Representation
{
    protected ?string $authenticator;
    protected ?string $authenticatorConfig;
    protected ?bool $authenticatorFlow;
    protected ?string $flowId;
    protected ?string $id;
    protected ?string $parentFlow;
    protected ?int $priority;
    protected ?string $requirement;
}
