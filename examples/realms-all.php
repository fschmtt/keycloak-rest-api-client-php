<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Builder;
use Fschmtt\Keycloak\OAuth\GrantType;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = (new Builder())
    ->withBaseUrl($_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080')
    ->withGrantType(GrantType::password('admin', 'admin'))
    ->build();

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
