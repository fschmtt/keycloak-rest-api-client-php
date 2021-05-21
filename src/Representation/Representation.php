<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Json\JsonDecoder;

abstract class Representation implements RepresentationInterface
{
    public function __construct(array $properties)
    {
        foreach ($properties as $property => $value) {
            $this->$property = $value;
        }
    }

    public static function fromJson(string $json): static
    {
        $decoder = new JsonDecoder();
        $properties = $decoder->decode($json);

        return new static($properties);
    }

    public function with(string $property, mixed $value): static
    {
        if (!property_exists(static::class, $property)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Property "%s" does not exist in "%s"',
                    $property,
                    static::class,
                )
            );
        }

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
}
