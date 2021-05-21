<?php

namespace Fschmtt\Keycloak\Representation;

abstract class DecisionStrategy implements \Stringable
{
    public function __toString(): string;
}
