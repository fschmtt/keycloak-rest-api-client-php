<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\CustomCommand;
use Fschmtt\Keycloak\Http\CustomQuery;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Keycloak;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    username: 'admin',
    password: 'admin',
);

$custom = $keycloak->custom();

$response = $custom->query(new CustomQuery(
    '/admin/custom/endpoint',
    new Criteria([
        'key' => 'value',
        'bool' => true,
    ])
));

$custom->command(new CustomCommand(
    '/admin/custom/endpoint',
    Method::POST,
    [
        'key' => 'value',
        'bool' => true,
    ]
));
