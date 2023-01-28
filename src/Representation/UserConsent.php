<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string|null getClientId()
 * @method int|null getCreatedDate()
 * @method array|null getGrantedClientScopes()
 * @method int|null getLastUpdatedDate()
 *
 * @codeCoverageIgnore
 */
class UserConsent extends Representation
{
    public function __construct(
        protected ?string $clientId,
        protected ?int $createdDate,
        protected ?array $grantedClientScopes,
        protected ?int $lastUpdatedDate,
    ) {
    }
}
