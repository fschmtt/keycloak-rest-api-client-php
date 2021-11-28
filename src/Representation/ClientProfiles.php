<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method ClientProfile[]|null getGlobalProfiles()
 * @method ClientProfile[]|null getProfiles()
 * @method self withGlobalProfiles(?array $globalProfiles)
 * @method self withProfiles(?array $profiles)
 */
class ClientProfiles extends Representation
{
    public function __construct(
        protected ?array $profiles = null,
        protected ?array $globalProfiles = null,
    ) {
        parent::__construct(
            $globalProfiles,
            $profiles,
        );
    }
}
