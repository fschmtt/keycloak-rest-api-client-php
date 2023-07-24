<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Credential;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<Credential>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class CredentialCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Credential::class;
    }
}
