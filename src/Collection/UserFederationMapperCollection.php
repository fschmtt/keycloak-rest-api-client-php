<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\UserFederationMapper;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<UserFederationMapper>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class UserFederationMapperCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return UserFederationMapper::class;
    }
}
