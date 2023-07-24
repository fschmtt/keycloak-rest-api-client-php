<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\AuthenticationExecutionExport;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<AuthenticationExecutionExport>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class AuthenticationExecutionExportCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return AuthenticationExecutionExport::class;
    }
}
