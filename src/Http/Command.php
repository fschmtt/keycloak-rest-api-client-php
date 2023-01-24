<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Representation\Representation;

class Command
{
    /**
     * @param Representation[]|Representation|null $payload
     */
    public function __construct(
        private readonly string $path,
        private readonly Method $method,
        private readonly array $parameters = [],
        private readonly array|Representation|null $payload = null,
    ) {
        if (is_array($payload)) {
            foreach ($payload as $representation) {
                if (!$representation instanceof Representation) {
                    throw new \TypeError(sprintf('"%s()" expects parameter 4 to be an array of Representation objects, but it contains "%s".', __METHOD__, get_debug_type($representation)));
                }
            }
        }
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

    public function getPayload(): array|Representation|null
    {
        return $this->payload;
    }
}
