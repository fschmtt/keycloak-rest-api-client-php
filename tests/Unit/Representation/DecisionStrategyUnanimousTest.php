<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\DecisionStrategyUnanimous
 */
class DecisionStrategyUnanimousTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        $this->assertSame(
            'UNANIMOUS',
            (string) (new DecisionStrategyUnanimous())
        );
    }
}
