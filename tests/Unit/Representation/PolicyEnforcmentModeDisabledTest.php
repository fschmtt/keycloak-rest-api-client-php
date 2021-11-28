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
        static::assertSame(
            'DISABLED',
            (string) (new PolicyEnforcementModeDisabled())
        );
    }
}
