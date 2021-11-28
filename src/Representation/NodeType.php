<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use InvalidArgumentException;
use Stringable;

/**
 * Since Keycloak 14.0.0
 */
abstract class NodeType implements Stringable
{
    /**
     * @throws InvalidArgumentException
     */
    final public static function from(string $nodeType): self
    {
        if (strtoupper($nodeType) === 'ARRAY') {
            return new ArrayNodeType();
        }

        if (strtoupper($nodeType) === 'BINARY') {
            return new BinaryNodeType();
        }

        if (strtoupper($nodeType) === 'BOOLEAN') {
            return new BooleanNodeType();
        }

        if (strtoupper($nodeType) === 'MISSING') {
            return new MissingNodeType();
        }

        if (strtoupper($nodeType) === 'NULL') {
            return new NullNodeType();
        }

        if (strtoupper($nodeType) === 'NUMBER') {
            return new NumberNodeType();
        }

        if (strtoupper($nodeType) === 'OBJECT') {
            return new ObjectNodeType();
        }

        if (strtoupper($nodeType) === 'POJO') {
            return new PojoNodeType();
        }

        if (strtoupper($nodeType) === 'STRING') {
            return new StringNodeType();
        }

        throw new InvalidArgumentException(
            sprintf('Unknown nodeType "%s"', $nodeType)
        );
    }
}
