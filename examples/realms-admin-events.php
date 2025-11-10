<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Builder;
use Fschmtt\Keycloak\OAuth\GrantType;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = (new Builder())
    ->withBaseUrl($_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080')
    ->withGrantType(GrantType::password('admin', 'admin'))
    ->build();

$realm = $keycloak->realms()->get('master');

$adminEvents = $keycloak->realms()->adminEvents($realm->getRealm());

echo sprintf('The following %d admin events happened on realm "%s":%s', count($adminEvents), $realm->getRealm(), PHP_EOL);

foreach ($adminEvents as $adminEvent) {
    print_r($adminEvent);
}
