<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\DecisionStrategyAffirmative
 * @uses \Fschmtt\Keycloak\Representation\Representation
 */
class DecisionStrategyAffirmativeTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        static::assertSame(
            'AFFIRMATIVE',
            (string) (new DecisionStrategyAffirmative())
        );
    }
}
