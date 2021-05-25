<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionType;

trait ValidatesProperty
{
    public function validate(string $property, mixed $value): void
    {
        $expectedType = $this->getPropertyType($property);

        if (str_starts_with((string) $expectedType, '?') && $property == null) {
            return;
        }

        $expectedType = substr((string) $expectedType, 1);

        if (!$property instanceof $expectedType) {
            throw new InvalidArgumentException(
                sprintf('Property "%s" must be an instance of "%s"', $property, $expectedType)
            );
        }
    }

    protected function serializeProperty(string $property)
    {
        $type = $this->getPropertyType($property);
    }

    private function getPropertyType(string $property): ReflectionType
    {
        $reflectedClass = new ReflectionClass(static::class);
        $reflectedProperty = $reflectedClass->getProperty($property);

        return $reflectedProperty->getType();
    }
}
