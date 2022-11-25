<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

enum DecisionStrategy: string implements Enum
{
    case AFFIRMATIVE = 'AFFIRMATIVE';
    case CONSENSUS = 'CONSENSUS';
    case UNANIMOUS = 'UNANIMOUS';
}
