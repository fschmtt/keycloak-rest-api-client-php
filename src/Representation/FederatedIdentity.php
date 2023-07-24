<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @method string|null getIdentityProvider()
 * @method string|null getUserId()
 * @method string|null getUserName()
 * @method self withIdentityProvider(?string $identityProvider)
 * @method self withUserId(?string $userId)
 * @method self withUserName(?string $userName)
 */
#[IgnoreClassForCodeCoverage(self::class)]
class FederatedIdentity extends Representation
{
    public function __construct(
        protected ?string $identityProvider,
        protected ?string $userId,
        protected ?string $userName
    ) {
    }
}
