<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Exception\SerializerException;

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

    /**
     * @throws SerializerException
     */
    public function serialize(string $type, mixed $value): mixed
    {
        if ($this->allowsNull($type) && $value === null) {
            return null;
        }

        $type = $this->disallowNull($type);

        if (\array_key_exists($type, $this->serializers)) {
            return $this->serializers[$type]->serialize($value);
        }

        throw new SerializerException(
            message: sprintf('No matching serializer found for type "%s"', $type)
        );
    }

    private function allowsNull(string $type): bool
    {
        return \str_starts_with($type, '?');
    }

    private function disallowNull(string $type): string
    {
        return \str_replace('?', '', $type);
    }
}
