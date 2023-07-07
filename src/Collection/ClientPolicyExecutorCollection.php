<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\ClientPolicyExecutor;

/**
 * @codeCoverageIgnore
 * @extends Collection<ClientPolicyExecutor>
 */
class ClientPolicyExecutorCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return ClientPolicyExecutor::class;
    }
}
