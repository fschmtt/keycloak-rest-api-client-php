<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\PolicyEnforcementModePermissive
 */
class PolicyEnforcementModePermissiveTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        self::assertSame(
            'PERMISSIVE',
            (string) (new PolicyEnforcementModePermissive())
        );
    }
}
