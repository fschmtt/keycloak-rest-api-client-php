<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

class Query
{
    private string $path;
    private string $returnType;
    private array $parameters;

    public function __construct(
        string $path,
        string $returnType,
        array $parameters = [],
    ) {
        $this->path = $path;
        $this->returnType = $returnType;
        $this->parameters = $parameters;
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
