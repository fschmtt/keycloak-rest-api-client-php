<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

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
