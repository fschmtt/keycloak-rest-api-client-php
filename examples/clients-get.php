<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\GrantType\Password;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    grantType: new Password('admin', 'admin'),
);

$resource = $keycloak->clients();
$clients = $keycloak->clients()->all(realm: 'master');
$client = $keycloak->clients()->get('master', $clients->first()->getId());

echo sprintf('Client "%s" (%s) has the following redirect URIs:%s', $client->getClientId(), $client->getId(), PHP_EOL);

foreach ($client->getRedirectUris() as $redirectUri) {
    echo sprintf('-> Redirect URI "%s"%s', $redirectUri, PHP_EOL);
}

$userSessions = $resource->getUserSessions('master', $client->getId());

echo sprintf('Client "%s" (%s) has the following %d user sessions:%s', $client->getClientId(), $client->getId(), count($userSessions), PHP_EOL);

foreach ($userSessions as $userSession) {
    print_r($userSession);
}
