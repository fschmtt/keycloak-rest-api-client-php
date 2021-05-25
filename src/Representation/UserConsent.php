<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class UserConsent extends Representation
{
    private ?string $clientId;

    private ?int $createdDate;

    /**
     * @var string[]|null
     */
    private ?array $grantedClientSCopes;

    private ?int $lastUpdatedDate;
}
