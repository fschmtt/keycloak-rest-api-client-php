<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\DecisionStrategyConsensus
 * @uses \Fschmtt\Keycloak\Representation\Representation
 */
class DecisionStrategyConsensusTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        static::assertSame(
            'CONSENSUS',
            (string) (new DecisionStrategyConsensus())
        );
    }
}
