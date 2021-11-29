<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Enum\PolicyEnforcementMode;

class PolicyEnforcementModeSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return PolicyEnforcementMode::class;
    }

    public function serialize($value): PolicyEnforcementMode
    {
        return PolicyEnforcementMode::from($value);
    }
}
