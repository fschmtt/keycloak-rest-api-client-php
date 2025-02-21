<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\GrantType\Password;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    grantType: new Password('admin', 'admin'),
);

// Fetch realm
$realm = $keycloak->realms()->get(realm: 'master');

// Disable registrations
$realm = $realm->withRegistrationAllowed(!$realm->getRegistrationAllowed());

// Update realm
$realm = $keycloak->realms()->update($realm->getRealm(), $realm);

var_dump($realm->getRegistrationAllowed());
