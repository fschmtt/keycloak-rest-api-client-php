<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method ClientPolicyCondition[]|null getConditions()
 * @method self withConditions(?string[] $conditions)
 *
 * @method string|null getDescription()
 * @method self withDescription(?string $description)
 *
 * @method bool|null getEnabled()
 * @method self withEnabled(?bool $enabled)
 *
 * @method string|null getName()
 * @method self withName(?string $name)
 *
 * @method string[]|null getProfiles()
 * @method self withProfiles(?string[] $profiles)
 *
 * @codeCoverageIgnore
 */
class ClientPolicy extends Representation
{
    public function __construct(
        /** @var string[]|null */
        protected ?array $conditions = null,
        protected ?string $description = null,
        protected ?bool $enabled = null,
        protected ?string $name = null,
        /** @var string[]|null */
        protected ?array $profiles = null,
    ) {}
}
