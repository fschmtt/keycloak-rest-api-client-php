<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method ClientProfile[]|null getProfiles()
 * @method self withProfilesProfiles(?array $profiles)
 */
class ClientProfiles extends Representation
{
    public function __construct(
        protected ?array $profiles = null
    ) {
        parent::__construct($profiles);
    }
}
