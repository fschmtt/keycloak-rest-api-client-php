<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\DecisionStrategyUnanimous
 * @uses \Fschmtt\Keycloak\Representation\Representation
 */
class DecisionStrategyUnanimousTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        static::assertSame(
            'UNANIMOUS',
            (string) (new DecisionStrategyUnanimous())
        );
    }
}
