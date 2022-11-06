<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\PropertyFilter;

use Fschmtt\Keycloak\Representation\Representation;

interface PropertyFilterInterface
{
    /**
     * @param class-string<Representation> $representation
     */
    public function filters(string $representation): bool;

    /**
     * @param array<string, mixed> $properties
     * @param string $version
     * @return array
     */
    public function filter(array $properties, string $version): array;
}
