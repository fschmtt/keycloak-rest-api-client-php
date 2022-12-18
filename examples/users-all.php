<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: 'http://keycloak:8080',
    username: 'admin',
    password: 'admin',
);

$realm = 'master';
$users = $keycloak->users()->all($realm);

echo sprintf('Realm "%s" has the following users:%s', $realm, PHP_EOL);

foreach ($users as $user) {
    echo sprintf('-> User "%s"%s', $user->getUsername(), PHP_EOL);
}
