<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ClientPolicy;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<ClientPolicy>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class ClientPolicyCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ClientPolicy::class;
    }
}
