<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: 'http://keycloak:8080',
    username: 'admin',
    password: 'admin'
);

$realm = $keycloak->realms()->get('master');

$users = $keycloak->realms()->users($realm);

echo sprintf('Realm "%s" has the following users:%s', $realm->getRealm(), PHP_EOL);

foreach ($users as $user) {
    echo sprintf('-> User "%s"%s', $user->getUsername(), PHP_EOL);
}
