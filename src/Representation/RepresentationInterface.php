<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Exception\PropertyIsReadOnlyException;

interface RepresentationInterface
{
    public static function from(array $properties): static;

    /**
     * @throws PropertyIsReadOnlyException
     */
    public function with(string $property, mixed $value): static;
}
