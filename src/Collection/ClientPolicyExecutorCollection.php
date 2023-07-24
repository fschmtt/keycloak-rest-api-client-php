<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ClientPolicyExecutor;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<ClientPolicyExecutor>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class ClientPolicyExecutorCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ClientPolicyExecutor::class;
    }
}
