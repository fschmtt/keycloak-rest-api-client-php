<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

class PolicyEnforcementModeEnforcingTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        static::assertSame(
            'ENFORCING',
            (string) (new PolicyEnforcementModeEnforcing())
        );
    }
}
