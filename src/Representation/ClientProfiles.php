<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ClientProfileCollection;

/**
 * @method ClientProfileCollection|null getGlobalProfiles()
 * @method self withGlobalProfiles(?ClientProfileCollection $globalProfiles)
 *
 * @method ClientProfileCollection|null getProfiles()
 * @method self withProfiles(?ClientProfileCollection $profiles)
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
