<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\GrantType\Password;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    grantType: new Password('admin', 'admin'),
);

$keycloak->attackDetection()->clear(
    realm: 'master',
);
