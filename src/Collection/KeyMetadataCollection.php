<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\KeyMetadata;

/**
 * @extends Collection<Credential>
 *
 * @codeCoverageIgnore
 */
class KeyMetadataCollection extends Collection
{
    public static function getRepresentationClass(): string
    {
        return KeyMetadata::class;
    }
}
