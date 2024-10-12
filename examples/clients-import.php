<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    username: 'admin',
    password: 'admin',
);

$resource = $keycloak->clients();
$clients = $keycloak->clients()->all(realm: 'master');
$client = $keycloak->clients()->get('master', $clients->first()->getId());

$random = bin2hex(random_bytes(length: 8));

$resource->import(
    'master',
    $client->withId(Uuid::uuid4()->toString())->withClientId('my-random-client-' . $random),
);
