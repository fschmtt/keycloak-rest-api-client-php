<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class NodeTypeTest extends TestCase
{
    /**
     * @dataProvider provideNodeTypes
     */
    public function testCreatesExpectedNodeType(string $providedNodeType, string $expectedNodeType): void
    {
        static::assertInstanceOf(
            $expectedNodeType,
            NodeType::from($providedNodeType)
        );

        static::assertEquals(
            $providedNodeType,
            (string) NodeType::from($providedNodeType)
        );
    }

    public function testThrowsExceptionOnInvalidNodeType(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage('Unknown nodeType "foo"');

        NodeType::from('foo');
    }

    public function provideNodeTypes(): array
    {
        return [
            ['ARRAY', NodeTypeArray::class],
            ['BINARY', NodeTypeBinary::class],
            ['BOOLEAN', NodeTypeBoolean::class],
            ['MISSING', NodeTypeMissing::class],
            ['NULL', NodeTypeNull::class],
            ['NUMBER', NodeTypeNumber::class],
            ['OBJECT', NodeTypeObject::class],
            ['POJO', NodeTypePojo::class],
            ['STRING', NodeTypeString::class],
        ];
    }
}
