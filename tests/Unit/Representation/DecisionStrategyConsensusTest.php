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
        $this->assertSame(
            'CONSENSUS',
            (string) (new DecisionStrategyConsensus())
        );
    }
}
