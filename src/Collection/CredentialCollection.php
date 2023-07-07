<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Credential;

/**
 * @codeCoverageIgnore
 * @extends Collection<Credential>
 */
class CredentialCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Credential::class;
    }
}
