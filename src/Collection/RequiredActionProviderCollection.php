<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\RequiredActionProvider;

/**
 * @codeCoverageIgnore
 */
class RequiredActionProviderCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return RequiredActionProvider::class;
    }
}
