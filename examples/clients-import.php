<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Builder;
use Fschmtt\Keycloak\OAuth\GrantType;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = (new Builder())
    ->withBaseUrl($_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080')
    ->withGrantType(GrantType::password('admin', 'admin'))
    ->build();

$resource = $keycloak->clients();
$clients = $keycloak->clients()->all(realm: 'master');
$client = $keycloak->clients()->get('master', $clients->first()->getId());

$random = bin2hex(random_bytes(length: 8));

$resource->import(
    'master',
    $client->withId(Uuid::uuid4()->toString())->withClientId('my-random-client-' . $random),
);
