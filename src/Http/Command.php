<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Representation\Representation;

class Command
{
    private string $path;
    private Method $method;
    private array $parameters;
    private ?Representation $representation;

    public function __construct(
        string $path,
        Method $method,
        array $parameters = [],
        ?Representation $representation = null,
    ) {
        $this->path = $path;
        $this->method = $method;
        $this->parameters = $parameters;
        $this->representation = $representation;
    }

    public function getMethod(): Method
    {
        return $this->method;
    }

    public function getPath(): string
    {
        $placeholders = array_map(
            static fn (string $parameter): string => '{' . $parameter . '}',
            array_keys($this->parameters),
        );

        $values = array_map(
            static function (mixed $value): string {
                if (is_bool($value)) {
                    return $value ? 'true' : 'false';
                }

                return (string) $value;
            },
            array_values($this->parameters)
        );

        return str_replace(
            $placeholders,
            $values,
            $this->path
        );
    }

    public function getRepresentation(): ?Representation
    {
        return $this->representation;
    }
}
