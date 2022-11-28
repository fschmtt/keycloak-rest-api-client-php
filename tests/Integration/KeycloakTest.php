<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class KeycloakTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testFetchesKeycloakVersionBeforeResourceIsAccessedForTheFirstTime(): void
    {
        $reflection = new ReflectionClass($this->getKeycloak());
        $version = $reflection->getProperty('version')->getValue($this->keycloak);

        static::assertNull($version);

        $this->keycloak->realms();

        $version = $reflection->getProperty('version')->getValue($this->keycloak);
        static::assertIsString($version);
    }
}
