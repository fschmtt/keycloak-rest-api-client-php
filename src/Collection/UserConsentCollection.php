<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\UserConsent;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<UserConsent>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class UserConsentCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return UserConsent::class;
    }
}
