<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ProtocolMapper;

/**
 * @method ProtocolMapper[] getIterator()
 */
class ProtocolMapperCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ProtocolMapper::class;
    }
}
