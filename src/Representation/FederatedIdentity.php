<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string|null getIdentityProvider()
 * @method self withIdentityProvider(?string $identityProvider)
 *
 * @method string|null getUserId()
 * @method self withUserId(?string $userId)
 *
 * @method string|null getUserName()
 * @method self withUserName(?string $userName)
 *
 * @codeCoverageIgnore
 */
class FederatedIdentity extends Representation
{
    public function __construct(
        protected ?string $identityProvider = null,
        protected ?string $userId = null,
        protected ?string $userName = null,
    ) {}
}
