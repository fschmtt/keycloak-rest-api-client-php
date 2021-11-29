<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

class DecisionStrategyUnanimousTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        static::assertSame(
            'UNANIMOUS',
            (string) (new DecisionStrategyUnanimous())
        );
    }
}
