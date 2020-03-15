<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\DecisionStrategyConsensus
 */
class DecisionStrategyConsensusTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        $this->assertSame(
            'CONSENSUS',
            (string) (new DecisionStrategyConsensus())
        );
    }
}
