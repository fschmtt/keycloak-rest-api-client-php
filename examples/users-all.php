<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\OAuth\GrantType\Password;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    grantType: new Password('admin', 'admin'),
);

$realm = 'master';
$users = $keycloak->users()->all($realm);

echo sprintf('Realm "%s" has the following users:%s', $realm, PHP_EOL);

foreach ($users as $user) {
    echo sprintf('-> User "%s"%s', $user->getUsername(), PHP_EOL);

    echo sprintf('--> Required actions:%s', PHP_EOL);

    foreach ($user->getRequiredActions() ?? [] as $requiredAction) {
        echo sprintf('---> %s%s', $requiredAction, PHP_EOL);
    }
}
