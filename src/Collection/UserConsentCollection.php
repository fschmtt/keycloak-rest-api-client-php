<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\UserConsent;

/**
 * @extends Collection<UserConsent>
 * @codeCoverageIgnore
 */
class UserConsentCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return UserConsent::class;
    }
}
