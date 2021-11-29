<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Exception\PropertyDoesNotExistException;
use Fschmtt\Keycloak\Json\JsonDecoder;
use Fschmtt\Keycloak\Serializer\Factory;
use Fschmtt\Keycloak\Serializer\Serializer;
use Fschmtt\Keycloak\Type\Type;
use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;

abstract class Representation implements RepresentationInterface, JsonSerializable
{
    private Serializer $serializer;

    public function __construct(...$properties)
    {
        $this->serializer = (new Factory())->create();
    }

    final public static function from(array $properties): static
    {
        /** @phpstan-ignore-next-line */
        $representation = new static();

        foreach ($properties as $property => $value) {
            $representation = $representation->withProperty($property, $value);
        }

        return $representation;
    }

    public static function fromJson(string $json): static
    {
        return static::from(
            (new JsonDecoder())->decode($json)
        );
    }

    final public function with(string $property, mixed $value): static
    {
        return $this->withProperty($property, $value);
    }

    final public function jsonSerialize(): array
    {
        $serializable = [];
        $reflectedClass = (new ReflectionClass($this));
        $properties = $reflectedClass->getProperties(ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $serializable[$property->getName()] = ($property instanceof Type)
                ? $property->jsonSerialize()
                : $property->getValue($this);
        }

        return $serializable;
    }

    final public function __call(string $name, array $arguments): mixed
    {
        if (str_starts_with($name, 'get')) {
            return $this->__get(lcfirst(substr($name, 3)));
        }

        if (str_starts_with($name, 'with')) {
            return $this->with(lcfirst(substr($name, 4)), $arguments[0]);
        }

        throw new PropertyDoesNotExistException();
    }

    final public function __get(string $name): mixed
    {
        $this->throwExceptionIfPropertyDoesNotExist($name);

        return $this->$name;
    }

    private function withProperty(string $property, mixed $value): static
    {
        $this->throwExceptionIfPropertyDoesNotExist($property);

        $type = $this->getPropertyType($property);
        $value = $this->serializer->serialize($type, $value);

        $clone = clone $this;
        $clone->$property = $value;

        return $clone;
    }

    /**
     * @throws PropertyDoesNotExistException
     */
    private function throwExceptionIfPropertyDoesNotExist(string $property): void
    {
        if (!property_exists(static::class, $property)) {
            throw new PropertyDoesNotExistException(
                sprintf(
                    'Property "%s" does not exist in "%s"',
                    $property,
                    static::class,
                )
            );
        }
    }

    private function getPropertyType(string $property): string
    {
        $reflectedClass = (new ReflectionClass($this));
        $properties = $reflectedClass->getProperties(ReflectionProperty::IS_PROTECTED);

        /** @var ReflectionProperty $prop */
        $prop = array_values(array_filter($properties, function (ReflectionProperty $p) use ($property) {
            return $p->getName() === $property;
        }))[0];

        return (string) $prop->getType();
    }
}
