<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Enum\Category;
use Fschmtt\Keycloak\Enum\DecisionStrategy;
use Fschmtt\Keycloak\Enum\Enum;
use Fschmtt\Keycloak\Enum\Logic;
use Fschmtt\Keycloak\Enum\NodeType;
use Fschmtt\Keycloak\Enum\Policy;
use Fschmtt\Keycloak\Enum\PolicyEnforcementMode;
use Fschmtt\Keycloak\Enum\UseEnum;
use Fschmtt\Keycloak\Serializer\EnumSerializer;
use Generator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Serializer\EnumSerializer
 */
class EnumSerializerTest extends TestCase
{
    public function testSerializes(): void
    {
        static::assertSame(
            Enum::class,
            (new EnumSerializer())->serializes()
        );
    }

    /**
     * @dataProvider enums
     */
    public function testSerialize(string $type, mixed $value, Enum $expected): void
    {
        $serializer = new EnumSerializer();

        static::assertEquals(
            $expected,
            $serializer->serialize($type, $value),
        );
    }

    public function enums(): Generator
    {
        yield Category::class => [Category::class, 'authorization_response', Category::AUTHORIZATION_RESPONSE];
        yield DecisionStrategy::class => [DecisionStrategy::class, 'cOnSeNsUs', DecisionStrategy::CONSENSUS];
        yield Logic::class => [Logic::class, 'NEGATIVE', Logic::NEGATIVE];
        yield NodeType::class => [NodeType::class, 'binary', NodeType::BINARY];
        yield Policy::class => [Policy::class, 'overwrite', Policy::OVERWRITE];
        yield PolicyEnforcementMode::class => [PolicyEnforcementMode::class, 'permissive', PolicyEnforcementMode::PERMISSIVE];
        yield UseEnum::class => [UseEnum::class, 'sig', UseEnum::SIG];
    }
}
