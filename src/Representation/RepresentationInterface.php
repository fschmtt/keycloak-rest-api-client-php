<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

interface RepresentationInterface
{
    public static function from(array $properties): static;

    public function with(string $property, mixed $value): static;
}
