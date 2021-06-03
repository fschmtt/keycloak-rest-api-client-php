<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration;

use Fschmtt\Keycloak\Keycloak;
use PHPUnit\Framework\TestCase;

abstract class IntegrationTestCase extends TestCase
{
    protected Keycloak $keycloak;

    public function setUp(): void
    {
        $this->keycloak = new Keycloak(
            'http://keycloak:8080',
            'admin',
            'admin'
        );
    }
}
