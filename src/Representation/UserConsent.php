<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @method string|null getClientId()
 * @method int|null getCreatedDate()
 * @method string[]|null getGrantedClientScopes()
 * @method int|null getLastUpdatedDate()
 */
#[IgnoreClassForCodeCoverage(self::class)]
class UserConsent extends Representation
{
    public function __construct(
        protected ?string $clientId,
        protected ?int $createdDate,
        /** @var string[]|null */
        protected ?array $grantedClientScopes,
        protected ?int $lastUpdatedDate,
    ) {
    }
}
