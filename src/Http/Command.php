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
        /** @var array<string, string> */
        private readonly array $parameters = [],
        /** @var Representation|Collection|array<mixed>|string|null */
        private readonly Representation|Collection|array|string|null $payload = null,
        private readonly ?Criteria $criteria = null,
        private readonly ContentType $contentType = ContentType::JSON,
    ) {}

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

        $path = str_replace(
            $placeholders,
            $values,
            $this->path,
        );

        return $path . $this->getQuery();
    }

    /**
     * @return Representation|Collection|array<mixed>|string|null
     */
    public function getPayload(): Representation|Collection|array|string|null
    {
        return $this->payload;
    }

    public function getQuery(): string
    {
        if (!$this->criteria) {
            return '';
        }

        return '?' . http_build_query($this->criteria->jsonSerialize());
    }

    public function getContentType(): ContentType
    {
        return $this->contentType;
    }
}
