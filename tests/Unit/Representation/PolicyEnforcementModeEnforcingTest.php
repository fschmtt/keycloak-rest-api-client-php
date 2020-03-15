<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\PolicyEnforcementModeEnforcing
 */
class PolicyEnforcementModeEnforcingTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        $this->assertSame(
            'ENFORCING',
            (string) (new PolicyEnforcementModeEnforcing())
        );
    }
}
