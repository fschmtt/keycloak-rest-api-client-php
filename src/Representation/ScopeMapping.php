<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @codeCoverageIgnore
 */
class ScopeMapping extends Representation
{
    public function __construct(
        protected ?string $self = null,
        protected ?string $client = null,
        protected ?string $clientTemplate = null,
        protected ?string $clientScope = null,
        /** @var string[]|null */
        protected ?array $roles = null,
    ) {
    }
}
