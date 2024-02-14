<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\KeyMetadataCollection;

/**
 * @method array|null getActive()
 * @method KeyMetadataCollection|null getKeys()
 * @method self withActive(?array $active)
 * @method self withKeyMetadataCollection(?KeyMetadataCollection $keys)
 *
 * @codeCoverageIgnore
 */
class KeysMetadata extends Representation
{
    /**
     * @param string[]|null $active
     * @param KeyMetadataCollection|null $keys
     */
    public function __construct(
        protected ?array $active = null,
        protected ?KeyMetadataCollection $keys = null,
    ) {
    }
}
