<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Attribute\Since;
use Fschmtt\Keycloak\Attribute\Until;
use Fschmtt\Keycloak\Representation\Representation;
use ReflectionClass;

class PropertyFilter
{
    private ?string $version;

    /**
     * @var array<class-string<Representation>, array<string, array{since?: string, until?: string}>>
     */
    private array $filteredProperties = [];

    public function __construct(?string $version = null)
    {
        $this->version = $version;
    }

    /**
     * @return array<string, mixed>
     */
    public function filter(Representation $representation): array
    {
        $properties = $representation->jsonSerialize();

        if (!$this->version) {
            return $properties;
        }

        foreach ($this->getFilteredProperties($representation) as $property => $versions) {
            if (isset($versions['since']) && (int) $this->version < (int) $versions['since']) {
                unset($properties[$property]);
            }

            if (isset($versions['until']) && (int) $this->version > (int) $versions['until']) {
                unset($properties[$property]);
            }
        }

        return $properties;
    }

    /**
     * @return array<string, array{since?: string, until?: string}>
     */
    private function getFilteredProperties(Representation $representation): array
    {
        if (array_key_exists($representation::class, $this->filteredProperties)) {
            return $this->filteredProperties[$representation::class];
        }

        $properties = (new ReflectionClass($representation))->getProperties();

        $filteredProperties = [];

        foreach ($properties as $property) {
            $sinceAttribute = $property->getAttributes(Since::class);
            $untilAttribute = $property->getAttributes(Until::class);

            foreach ($sinceAttribute as $since) {
                $filteredProperties[$property->getName()]['since'] = $since->getArguments()[0];
            }

            foreach ($untilAttribute as $until) {
                $filteredProperties[$property->getName()]['until'] = $until->getArguments()[0];
            }
        }

        $this->filteredProperties[$representation::class] = $filteredProperties;

        return $filteredProperties;
    }
}
