<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @codeCoverageIgnore
 *
 * @method string|null getName()
 * @method self withName(?string $name)
 *
 * @method bool|null getVerified()
 * @method self withVerified(?bool $verified)
 */
class OrganizationDomain extends Representation
{
    public function __construct(
        protected ?string $name = null,
        protected ?bool $verified = null,
    ) {}
}
