<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\PasswordPolicyType;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @extends Collection<PasswordPolicyType>
 */
#[IgnoreClassForCodeCoverage(self::class)]
class PasswordPolicyTypeCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return PasswordPolicyType::class;
    }
}
