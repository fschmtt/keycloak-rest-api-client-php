<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Collection\Collection;
use Fschmtt\Keycloak\Representation\Representation;

class Command
{
    public function __construct(
        private readonly string $path,
        private readonly Method $method,
        /** @var array<string, string> $parameters */
        private readonly array $parameters = [],
        /** @var Representation|Collection|array<mixed>|null $payload */
        private readonly Representation|Collection|array|null $payload = null,
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

    /**
     * @return Representation|Collection|array<mixed>|null
     */
    public function getPayload(): Representation|Collection|array|null
    {
        return $this->payload;
    }
}
