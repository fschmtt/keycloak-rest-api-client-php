<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Representation\Representation;

class Command
{
    public function __construct(
        private readonly string $path,
        private readonly Method $method,
        private readonly array $parameters = [],
        private readonly ?Representation $representation = null,
    ) {
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

        $values = array_values($this->parameters);

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
