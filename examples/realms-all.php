<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\Representation\Realm;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: 'http://keycloak:8080',
    username: 'admin',
    password: 'admin'
);

$realms = $keycloak->realms()->all();

foreach ($realms as $realm) {
    echo sprintf(
        'Realm "%s" %s registrations%s',
        $realm->getRealm(),
        $realm->getRegistrationAllowed() ? 'allows' : 'forbids',
        PHP_EOL
    );
}
