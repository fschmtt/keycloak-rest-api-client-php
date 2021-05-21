<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class DecisionStrategyAffirmative extends DecisionStrategy
{
    public function __toString(): string
    {
        return 'AFFIRMATIVE';
    }
}
