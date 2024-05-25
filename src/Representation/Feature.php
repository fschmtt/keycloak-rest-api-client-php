<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string|null getName()
 * @method string|null getLabel()
 * @method string|null getType()
 * @method string[]|null getDependencies()
 * @method bool|null getEnabled()
 *
 * @codeCoverageIgnore
 */
class Feature extends Representation
{
    public function __construct(
        protected ?string $name = null,
        protected ?string $label = null,
        protected ?string $type = null,
        /** @var string[]|null $dependencies */
        protected ?array $dependencies = null,
        protected ?bool $enabled = null,
    ) {
    }
}
