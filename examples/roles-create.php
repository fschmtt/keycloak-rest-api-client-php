<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Collection\OrganizationDomainCollection;
use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\Representation\OrganizationDomain;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\Organization;
use Fschmtt\Keycloak\Representation\Role;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    username: 'admin',
    password: 'admin',
);

$realm = 'master';

$role = new Role(
    name: 'my-role',
);

$response = $keycloak->roles()->create($realm, $role);

var_dump($response);
