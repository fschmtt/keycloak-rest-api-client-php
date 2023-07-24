<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\QueryExecutor;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

#[IgnoreClassForCodeCoverage(self::class)]
abstract class Resource
{
    public function __construct(
        protected readonly CommandExecutor $commandExecutor,
        protected readonly QueryExecutor $queryExecutor,
    ) {
    }
}
