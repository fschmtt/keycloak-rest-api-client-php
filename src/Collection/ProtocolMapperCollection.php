<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ProtocolMapper;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<ProtocolMapper>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class ProtocolMapperCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ProtocolMapper::class;
    }
}
