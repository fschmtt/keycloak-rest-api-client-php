<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\PolicyEnforcementModePermissive
 */
class PolicyEnforcmentModePermissiveTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        $this->assertSame(
            'PERMISSIVE',
            (string) (new PolicyEnforcementModePermissive())
        );
    }
}
