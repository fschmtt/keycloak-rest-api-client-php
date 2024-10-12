<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ClientProfileCollection;

/**
 * @method ClientProfileCollection|null getGlobalProfiles()
 * @method ClientProfileCollection|null getProfiles()
 * @method self withGlobalProfiles(?array $globalProfiles)
 * @method self withProfiles(?array $profiles)
 *
 * @codeCoverageIgnore
 */
class ClientProfiles extends Representation
{
    public function __construct(
        protected ?ClientProfileCollection $profiles = null,
        protected ?ClientProfileCollection $globalProfiles = null,
    ) {}
}
