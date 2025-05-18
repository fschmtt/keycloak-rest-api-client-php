<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

class Query
{
    public function __construct(
        private readonly string $path,
        private readonly string $returnType,
        /** @var array<string, string> */
        private readonly array $parameters = [],
        private readonly ?Criteria $criteria = null,
    ) {}

    public function getMethod(): Method
    {
        return Method::GET;
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

    private function getQuery(): string
    {
        if (!$this->criteria) {
            return '';
        }

        return '?' . http_build_query($this->criteria->jsonSerialize());
    }

    public function getReturnType(): string
    {
        return $this->returnType;
    }
}
