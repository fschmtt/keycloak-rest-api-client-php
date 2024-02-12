<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Builder;
use Fschmtt\Keycloak\OAuth\GrantType;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = (new Builder())
    ->withBaseUrl($_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080')
    ->withGrantType(GrantType::password('admin', 'admin'))
    ->build();

$userStatus = $keycloak->attackDetection()->userStatus(
    realm: 'master',
    userId: 'afab8ba7-e278-4dda-8970-bd5a2a4c7bfb',
);

foreach ($userStatus as $key => $value) {
    echo sprintf('%s: %s%s', $key, $value, PHP_EOL);
}
