<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration;

use Fschmtt\Keycloak\Keycloak;

trait IntegrationTestBehaviour
{
    private static ?Keycloak $keycloak = null;

    public static function getKeycloak(): Keycloak
    {
        if (!self::$keycloak) {
            self::$keycloak = new Keycloak(
                $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
                'admin',
                'admin',
            );
        }

        return self::$keycloak;
    }

    protected function skipIfKeycloakVersionIsLessThan(string $version): void
    {
        if (version_compare(self::getKeycloak()->getVersion(), $version, '<')) {
            $this->markTestSkipped(sprintf('Keycloak version is less than %s', $version));
        }
    }

    protected function skipIfKeycloakVersionIsGreaterThan(string $version): void
    {
        if (version_compare(self::getKeycloak()->getVersion(), $version, '>')) {
            $this->markTestSkipped(sprintf('Keycloak version is greater than %s', $version));
        }
    }
}
