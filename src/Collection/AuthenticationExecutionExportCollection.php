<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\AuthenticationExecutionExport;

/**
 * @codeCoverageIgnore
 * @extends Collection<AuthenticationExecutionExport>
 */
class AuthenticationExecutionExportCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return AuthenticationExecutionExport::class;
    }
}
