<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

class CustomQuery extends Query
{
    public function __construct(
        string $path,
        ?Criteria $criteria = null,
        string $returnType = 'array',
    ) {
        parent::__construct($path, $returnType, [], $criteria);
    }
}
