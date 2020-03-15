<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\PolicyEnforcementModeDisabled
 */
class PolicyEnforcmentModeDisabledTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        $this->assertSame(
            'DISABLED',
            (string) (new PolicyEnforcementModeDisabled())
        );
    }
}
