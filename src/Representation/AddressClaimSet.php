<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

#[IgnoreClassForCodeCoverage(self::class)]
class AddressClaimSet extends Representation
{
    protected ?string $country;
    protected ?string $formatted;
    protected ?string $locality;
    protected ?string $postal_code;
    protected ?string $region;
    protected ?string $street_address;
}
