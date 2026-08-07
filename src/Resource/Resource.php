<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\QueryExecutor;

/**
 * @codeCoverageIgnore
 */
abstract class Resource
{
    public function __construct(
        protected readonly CommandExecutor $commandExecutor,
        protected readonly QueryExecutor $queryExecutor,
        protected readonly ?string $defaultRealm = null,
    ) {}

    protected function resolveRealm(?string $realm): string
    {
        if (is_string($realm) && $realm !== '') {
            return $realm;
        }

        if (is_string($this->defaultRealm) && $this->defaultRealm !== '') {
            return $this->defaultRealm;
        }

        throw new \InvalidArgumentException('No realm configured. Pass a realm to the method or configure a default realm in the Builder.');
    }
}
