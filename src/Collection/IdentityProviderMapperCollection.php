<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\IdentityProviderMapper;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<IdentityProviderMapper>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class IdentityProviderMapperCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return IdentityProviderMapper::class;
    }
}
