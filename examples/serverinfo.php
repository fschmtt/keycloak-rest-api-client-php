<?php

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new \Fschmtt\Keycloak\Keycloak(
    'https://localhost',
    'admin',
    'password'
);

$serverInfo = $keycloak->getServerInfo();

echo sprintf(
    'Keycloak is currently using %s of %s memory.',
    $serverInfo->getMemoryInfo()->getUsedFormatted(),
    $serverInfo->getMemoryInfo()->getTotalFormatted()
);
