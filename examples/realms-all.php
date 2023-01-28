<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    username: 'admin',
    password: 'admin',
);

$realms = $keycloak->realms()->all();

foreach ($realms as $realm) {
    echo sprintf(
        'Realm "%s" %s registrations%s',
        $realm->getRealm(),
        $realm->getRegistrationAllowed() ? 'allows' : 'forbids',
        PHP_EOL,
    );

    echo sprintf(
        'Realm "%s" has the following %d default groups: %s%s',
        $realm->getRealm(),
        $realm->getDefaultGroups() ? count($realm->getDefaultGroups()) : 0,
        $realm->getDefaultGroups() ? implode(',', $realm->getDefaultGroups()) : '',
        PHP_EOL,
    );

    echo sprintf('---%s', PHP_EOL);
}
