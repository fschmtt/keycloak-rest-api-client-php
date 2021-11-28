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

$clients = $keycloak->realms()->clients($realm);

echo sprintf('Realm "%s" has the following clients:%s', $realm->getRealm(), PHP_EOL);

foreach ($clients as $client) {
    echo sprintf('-> Client "%s"%s', $client->getClientId(), PHP_EOL);
}
