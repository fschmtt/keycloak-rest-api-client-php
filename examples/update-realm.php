<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: 'http://keycloak:8080',
    username: 'admin',
    password: 'admin'
);

// Fetch realm
$realm = $keycloak->realms()->get(realm: 'master');

// Disable registrations
$realm = $realm->with('registrationAllowed', false);

// Update realm
$keycloak->realms()->update($realm);