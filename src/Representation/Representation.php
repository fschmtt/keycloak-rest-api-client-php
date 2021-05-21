<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Json\JsonDecoder;
use InvalidArgumentException;

abstract class Representation implements RepresentationInterface
{
    final public function __construct()
    {
        //
    }

    public static function from(array $properties): static
    {
        $representation = new static();

        foreach ($properties as $property => $value) {
            $representation = $representation->with($property, $value);
        }

        return $representation;
    }

    public static function fromJson(string $json): static
    {
        $decoder = new JsonDecoder();
        $properties = $decoder->decode($json);

        return static::from($properties);
    }

    public function with(string $property, mixed $value): static
    {
        $this->throwExceptionIfPropertyDoesNotExist($property);

        $clone = clone $this;
        $clone->$property = $value;

        return $clone;
    }

    public function __call(string $name, array $arguments): mixed
    {
        if (str_starts_with($name, 'get')) {
            return $this->__get(lcfirst(substr($name, 3)));
        }

        if (str_starts_with($name, 'with')) {
            return $this->with(lcfirst(substr($name, 4)), $arguments[0]);
        }

        throw new \RuntimeException();
    }

    public function __get(string $name): mixed
    {
        return $this->$name;
    }

    private function throwExceptionIfPropertyDoesNotExist(string $property): void
    {
        if (!property_exists(static::class, $property)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Property "%s" does not exist in "%s"',
                    $property,
                    static::class,
                )
            );
        }
    }
}
