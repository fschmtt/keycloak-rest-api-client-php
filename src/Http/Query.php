<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

class Query
{
    public function __construct(
        private readonly string $path,
        private readonly string $returnType,
        private readonly array $parameters = [],
    ) {
    }

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

    public function getReturnType(): string
    {
        return $this->returnType;
    }
}
