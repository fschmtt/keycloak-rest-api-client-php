<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

class DecisionStrategyConsensus extends DecisionStrategy
{
    public function __toString(): string
    {
        return 'CONSENSUS';
    }
}
