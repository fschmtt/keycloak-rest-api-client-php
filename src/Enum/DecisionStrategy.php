<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

abstract class DecisionStrategy extends Enum
{
    protected static function match(string $value): static
    {
        return match (strtoupper($value)) {
            'AFFIRMATIVE' => new DecisionStrategyAffirmative(),
            'CONSENSUS' => new DecisionStrategyConsensus(),
            'UNANIMOUS' => new DecisionStrategyUnanimous(),
        };
    }
}
