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

$resource = $keycloak->clients();
$clients = $keycloak->clients()->all(realm: $realm->getRealm());

echo sprintf('Realm "%s" has the following clients:%s', $realm->getRealm(), PHP_EOL);

foreach ($clients as $client) {
    echo sprintf('-> %s (%s)%s', $client->getClientId(), $client->getId(), PHP_EOL);
}
