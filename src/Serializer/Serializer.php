<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Exception;
use Fschmtt\Keycloak\Collection\Collection;
use Fschmtt\Keycloak\Enum\Enum;
use Fschmtt\Keycloak\Exception\SerializerException;
use Fschmtt\Keycloak\Representation\Representation;

/**
 * @internal
 */
class Serializer implements SerializerInterface
{
    private const NATIVE_TYPES = [
        'array',
        'bool',
        'int',
        'string',
    ];

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

    public function serializes(): string
    {
        throw new Exception(sprintf('Use (new %s)->create())->serialize()', Factory::class));
    }

    /**
     * @throws SerializerException
     */
    public function serialize(string $type, mixed $value): mixed
    {
        if ($value === null && $this->allowsNull($type)) {
            return null;
        }

        $type = $this->disallowNull($type);
        $abstractType = $type;

        if ($this->isRepresentationType($type)) {
            $abstractType = Representation::class;
        }

        if ($this->isCollectionType($type)) {
            $abstractType = Collection::class;
        }

        if ($this->isEnumType($type)) {
            $abstractType = Enum::class;
        }

        if (array_key_exists($abstractType, $this->serializers)) {
            return $this->serializers[$abstractType]->serialize($type, $value);
        }

        throw new SerializerException(
            message: sprintf('No matching serializer found for type "%s"', $type),
        );
    }

    private function allowsNull(string $type): bool
    {
        return str_starts_with($type, '?');
    }

    private function disallowNull(string $type): string
    {
        return str_replace('?', '', $type);
    }

    private function isNativeType(string $type): bool
    {
        return in_array($type, self::NATIVE_TYPES, true);
    }

    private function isRepresentationType(string $type): bool
    {
        if ($this->isNativeType($type)) {
            return false;
        }

        $namespace = explode('\\', $type);

        return in_array('Representation', $namespace, true);
    }

    private function isCollectionType(string $type): bool
    {
        if ($this->isNativeType($type)) {
            return false;
        }

        if ($this->isRepresentationType($type)) {
            return false;
        }

        $namespace = explode('\\', $type);

        return in_array('Collection', $namespace, true);
    }

    private function isEnumType(string $type): bool
    {
        if ($this->isNativeType($type)) {
            return false;
        }

        if ($this->isRepresentationType($type)) {
            return false;
        }

        if ($this->isCollectionType($type)) {
            return false;
        }

        $namespace = explode('\\', $type);

        return in_array('Enum', $namespace, true);
    }
}
