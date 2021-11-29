<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\PasswordPolicyType;

/**
 * @method PasswordPolicyType[] getIterator()
 */
class PasswordPolicyTypeCollection extends Collection
{
    public function getRepresentationClass(): string
    {
        return PasswordPolicyType::class;
    }
}
