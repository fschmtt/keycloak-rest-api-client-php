<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

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
