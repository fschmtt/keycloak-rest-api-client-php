<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\KeyMetadataCollection;

/**
 * @method string[]|null getActive()
 * @method self withActive(?string[] $active)
 *
 * @method KeyMetadataCollection|null getKeys()
 * @method self withKeyMetadataCollection(?KeyMetadataCollection $keys)
 *
 * @codeCoverageIgnore
 */
class KeysMetadata extends Representation
{
    public function __construct(
        /** @var string[]|null $active */
        protected ?array $active = null,
        protected ?KeyMetadataCollection $keys = null,
    ) {}
}
