<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration;

use Fschmtt\Keycloak\Keycloak;

trait IntegrationTestBehaviour
{
    private ?Keycloak $keycloak = null;

    public function getKeycloak(): Keycloak
    {
        if (!$this->keycloak) {
            $this->keycloak = new Keycloak(
                $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
                'admin',
                'admin',
            );
        }

        return $this->keycloak;
    }

    protected function skipIfKeycloakVersionIsLessThan(string $version): void
    {
        if (version_compare($this->getKeycloak()->getVersion(), $version, '<')) {
            $this->markTestSkipped(sprintf('Keycloak version is less than %s', $version));
        }
    }

    protected function skipIfKeycloakVersionIsGreaterThan(string $version): void
    {
        if (version_compare($this->getKeycloak()->getVersion(), $version, '>')) {
            $this->markTestSkipped(sprintf('Keycloak version is greater than %s', $version));
        }
    }
}
