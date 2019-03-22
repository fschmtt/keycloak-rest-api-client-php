<?php

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new \Fschmtt\Keycloak\Keycloak(
    'http://localhost:8080',
    'admin',
    'admin'
);

$serverInfo = $keycloak->getServerInfo();

echo sprintf(
    'Keycloak is currently using %s of %s memory.',
    $serverInfo->getMemoryInfo()->getUsedFormatted(),
    $serverInfo->getMemoryInfo()->getTotalFormatted()
);
