<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

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
