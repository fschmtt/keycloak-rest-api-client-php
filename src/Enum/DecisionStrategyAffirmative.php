<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class DecisionStrategyAffirmative extends DecisionStrategy
{
    public function __toString(): string
    {
        return 'AFFIRMATIVE';
    }
}
