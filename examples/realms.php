<?php

use Fschmtt\Keycloak\Representation\Realm;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new \Fschmtt\Keycloak\Keycloak(
    'http://localhost:8080',
    'admin',
    'admin'
);

$realms = $keycloak->getRealms();

/** @var Realm $realm */
foreach ($realms as $realm) {
    print_r($realm);
}
