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
    protected CommandExecutor $commandExecutor;

    protected QueryExecutor $queryExecutor;

    public function __construct(
        CommandExecutor $commandExecutor,
        QueryExecutor $queryExecutor,
    ) {
        $this->commandExecutor = $commandExecutor;
        $this->queryExecutor = $queryExecutor;
    }
}
