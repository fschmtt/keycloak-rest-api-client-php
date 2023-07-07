<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Policy;

/**
 * @codeCoverageIgnore
 * @extends Collection<Policy>
 */
class PolicyCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return Policy::class;
    }
}
