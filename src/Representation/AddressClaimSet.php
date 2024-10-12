<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @codeCoverageIgnore
 */
class AddressClaimSet extends Representation
{
    public function __construct(
        protected ?string $country = null,
        protected ?string $formatted = null,
        protected ?string $locality = null,
        protected ?string $postal_code = null,
        protected ?string $region = null,
        protected ?string $street_address = null,
    ) {}
}
