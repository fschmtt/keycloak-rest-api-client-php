<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Client;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<Client>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class ClientCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Client::class;
    }
}
