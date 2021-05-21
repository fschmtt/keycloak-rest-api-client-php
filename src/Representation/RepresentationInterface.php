<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Exception\ReadOnlyException;

interface RepresentationInterface
{
    public static function from(array $properties): static;

    /**
     * @throws ReadOnlyException
     */
    public function with(string $property, mixed $value): static;
}
