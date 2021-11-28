<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Exception\SerializerException;

use function array_key_exists;

class Serializer
{
    /**
     * @var array<string, SerializerInterface>
     */
    private array $serializers = [];

    public function __construct(SerializerInterface ...$serializers)
    {
        foreach ($serializers as $serializer) {
            $this->serializers[$serializer->serializes()] = $serializer;
        }
    }

    public function serialize(string $type, mixed $value): mixed
    {
        if (array_key_exists($type, $this->serializers)) {
            return $this->serializers[$type]->serialize($value);
        }

        try {
            // Try to fall back to string
            return $this->serializers['string']->serialize($value);
        } catch (\Throwable $e) {
            throw new SerializerException(
                message: sprintf('No matching serializer found for type "%s"', $type),
                previous: $e
            );
        }
    }
}
