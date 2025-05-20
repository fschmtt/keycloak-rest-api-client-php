<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\GrantType\Password;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    grantType: new Password('admin', 'admin'),
);

$realm = $keycloak->realms()->get('master');

$adminEvents = $keycloak->realms()->adminEvents($realm->getRealm());

echo sprintf('The following %d admin events happened on realm "%s":%s', count($adminEvents), $realm->getRealm(), PHP_EOL);

foreach ($adminEvents as $adminEvent) {
    print_r($adminEvent);
}
