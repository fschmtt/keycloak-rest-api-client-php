<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

class DecisionStrategyTest extends TestCase
{
    /**
     * @dataProvider provideDecisionStrategies
     */
    public function testCreatesExpectedDecisionStrategy(string $providedDecisionStrategy, string $expectedDecisionStrategy): void
    {
        static::assertInstanceOf(
            $expectedDecisionStrategy,
            DecisionStrategy::from($providedDecisionStrategy)
        );

        static::assertEquals(
            $providedDecisionStrategy,
            (string) DecisionStrategy::from($providedDecisionStrategy)
        );
    }

    public function provideDecisionStrategies(): array
    {
        return [
            ['AFFIRMATIVE', DecisionStrategyAffirmative::class],
            ['CONSENSUS', DecisionStrategyConsensus::class],
            ['UNANIMOUS', DecisionStrategyUnanimous::class],
        ];
    }
}
