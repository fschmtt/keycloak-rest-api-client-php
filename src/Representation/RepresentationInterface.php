<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

interface RepresentationInterface
{
    public function __construct(array $properties);

    public function with(string $property, mixed $value): self;
}
