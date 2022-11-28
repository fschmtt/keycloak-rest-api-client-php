<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\Representation\Realm;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: 'http://keycloak:8080',
    username: 'admin',
    password: 'admin',
    version: '20.0.0',
);

$random = bin2hex(random_bytes(length: 8));

$realm = $keycloak->realms()->import(
    new Realm(
        displayName: 'My Random Realm ' . $random,
        id: 'my-random-realm-' . $random,
        realm: 'my-random-realm-' . $random,
    )
);

$keycloak->realms()->delete($realm);
