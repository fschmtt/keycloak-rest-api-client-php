<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

/**
 * @method string|null getAlias()
 * @method self withAlias(?string $alias)
 * @method Map|null getConfig()
 * @method self withConfig(?Map $config)
 * @method bool|null getDefaultAction()
 * @method self withDefaultAction(?bool $defaultAction)
 * @method bool|null getEnabled()
 * @method self withEnabled(?bool $enabled)
 * @method string|null getName()
 * @method self withName(?string $name)
 * @method bool|null getPriority()
 * @method self withPriority(?bool $priority)
 * @method string|null getProviderId()
 * @method self withProviderId(?string $providerId)
 */
#[IgnoreClassForCodeCoverage(self::class)]
class RequiredActionProvider extends Representation
{
    public function __construct(
        protected ?string $alias = null,
        protected ?Map $config = null,
        protected ?bool $defaultAction = null,
        protected ?bool $enabled = null,
        protected ?string $name = null,
        protected ?bool $priority = null,
        protected ?string $providerId = null,
    ) {
    }
}
