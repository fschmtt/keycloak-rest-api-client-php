<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class AuthenticationExecutionExport extends Representation
{
    protected ?string $authenticator;

    protected ?string $authenticatorConfig;

    protected ?bool $authenticatorFlow;

    protected ?string $flowAlias;

    protected ?int $priority;

    protected ?string $requirement;

    protected ?bool $userSetupAllowed;
}
