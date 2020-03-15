<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class DecisionStrategyUnanimous implements DecisionStrategy
{
    public function __toString(): string
    {
        return 'UNANIMOUS';
    }
}
