<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Builder;
use Fschmtt\Keycloak\OAuth\GrantType;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = (new Builder())
    ->withBaseUrl($_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080')
    ->withGrantType(GrantType::password('admin', 'admin'))
    ->build();

// Fetch realm
$realm = $keycloak->realms()->get(realm: 'master');

// Disable registrations
$realm = $realm->withRegistrationAllowed(!$realm->getRegistrationAllowed());

// Update realm
$realm = $keycloak->realms()->update($realm->getRealm(), $realm);

var_dump($realm->getRegistrationAllowed());
