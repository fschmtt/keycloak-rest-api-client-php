<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\AuthenticationExecutionExportCollection;

/**
 * @method string|null getAlias()
 * @method self withAlias(?string $alias)
 *
 * @method AuthenticationExecutionExportCollection|null getAuthenticationExecutions()
 * @method self withAuthenticationExecutions(?AuthenticationExecutionExportCollection $authenticationExecutions)
 *
 * @method bool|null getBuiltin()
 * @method self withBuiltin(?bool $builtin)
 *
 * @method string|null getDescription()
 * @method self withDescription(?string $description)
 *
 * @method string|null getId()
 * @method self withId(?string $id)
 *
 * @method string|null getProviderId()
 * @method self withProviderId(?string $providerId)
 *
 * @method bool|null getTopLevel()
 * @method self withTopLevel(?bool $topLevel)
 *
 * @codeCoverageIgnore
 */
class AuthenticationFlow extends Representation
{
    public function __construct(
        protected ?string $alias = null,
        protected ?AuthenticationExecutionExportCollection $authenticationExecutions = null,
        protected ?bool $builtIn = null,
        protected ?string $description = null,
        protected ?string $id = null,
        protected ?string $providerId = null,
        protected ?bool $topLevel = null,
    ) {}
}
