<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method ClientPolicyCondition[]|null getConditions()
 * @method string|null getDescription()
 * @method bool|null getEnabled()
 * @method string|null getName()
 * @method string[]|null getProfiles()
 * @method self withConditions(?array $conditions)
 * @method self withDescription(?array $description)
 * @method self withEnabled(?bool $enabled)
 * @method self withName(?string $name)
 * @method self withProfiles(?array $profiles)
 *
 * @codeCoverageIgnore
 */
class ClientPolicy extends Representation
{
    public function __construct(
        /** @var string[] */
        protected ?array $conditions = null,
        protected ?string $description = null,
        protected ?bool $enabled = null,
        protected ?string $name = null,
        /** @var string[] */
        protected ?array $profiles = null,
    ) {
    }
}
