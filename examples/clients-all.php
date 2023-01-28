<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    username: 'admin',
    password: 'admin',
);

$realm = $keycloak->realms()->get('master');

$resource = $keycloak->clients();
$clients = $keycloak->clients()->all(realm: $realm->getRealm());

echo sprintf('Realm "%s" has the following clients:%s', $realm->getRealm(), PHP_EOL);

foreach ($clients as $client) {
    echo sprintf('-> %s (%s)%s', $client->getClientId(), $client->getId(), PHP_EOL);
}
