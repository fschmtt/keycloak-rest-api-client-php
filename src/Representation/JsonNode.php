<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Enum\NodeType;

/**
 * @codeCoverageIgnore
 */
class JsonNode extends Representation
{
    public function __construct(
        protected ?bool $array = null,
        protected ?bool $bigDecimal = null,
        protected ?bool $bigInteger = null,
        protected ?bool $binary = null,
        protected ?bool $boolean = null,
        protected ?bool $containerNode = null,
        protected ?bool $double = null,
        protected ?bool $empty = null,
        protected ?bool $float = null,
        protected ?bool $floatingPointNumber = null,
        protected ?bool $int = null,
        protected ?bool $integralNumber = null,
        protected ?bool $long = null,
        protected ?bool $missingNode = null,
        protected ?NodeType $nodeType = null,
        protected ?bool $null = null,
        protected ?bool $number = null,
        protected ?bool $object = null,
        protected ?bool $pojo = null,
        protected ?bool $short = null,
        protected ?bool $textual = null,
        protected ?bool $valueNode = null,
    ) {
    }
}
