<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration;

use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\GrantType\Password;

trait IntegrationTestBehaviour
{
    private ?Keycloak $keycloak = null;

    public function getKeycloak(): Keycloak
    {
        if (!$this->keycloak) {
            $this->keycloak = new Keycloak(
                baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
                grantType: new Password('admin', 'admin'),
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
