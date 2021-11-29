<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

class DecisionStrategyAffirmativeTest extends TestCase
{
    public function testConvertsCorrectlyToString()
    {
        static::assertSame(
            'AFFIRMATIVE',
            (string) (new DecisionStrategyAffirmative())
        );
    }
}
