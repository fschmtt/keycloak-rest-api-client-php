<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\DecisionStrategyAffirmative
 */
class DecisionStrategyAffirmativeTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        $this->assertSame(
            'AFFIRMATIVE',
            (string) (new DecisionStrategyAffirmative())
        );
    }
}
