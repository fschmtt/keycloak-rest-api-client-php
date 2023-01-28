<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\AuthenticationExecutionExportCollection;

/**
 * @method string|null getAlias()
 * @method AuthenticationExecutionExportCollection|null getAuthenticationExecutions()
 * @method bool|null getBuiltin()
 * @method string|null getDescription()
 * @method string|null getId()
 * @method string|null getProviderId()
 * @method bool|null getTopLevel()
 * @method self withAlias(?string $alias)
 * @method self withAuthenticationExecutions(?AuthenticationExecutionExportCollection $authenticationExecutions)
 * @method self withBuiltin(?bool $builtin)
 * @method self withDescription(?string $description)
 * @method self withId(?string $id)
 * @method self withProviderId(?string $providerId)
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
    ) {
    }
}
