<?php

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new \Fschmtt\Keycloak\Keycloak(
    'http://keycloak:8080',
    'admin',
    'admin'
);

$serverInfo = $keycloak->getServerInfo();

echo sprintf(
    'Keycloak %s is running on %s/%s (%s) with %s/%s since %s and is currently using %s of %s (%s %%) memory.',
    $serverInfo->getSystemInfo()->getVersion(),
    $serverInfo->getSystemInfo()->getOsName(),
    $serverInfo->getSystemInfo()->getOsVersion(),
    $serverInfo->getSystemInfo()->getOsArchitecture(),
    $serverInfo->getSystemInfo()->getJavaVm(),
    $serverInfo->getSystemInfo()->getJavaVersion(),
    $serverInfo->getSystemInfo()->getUptime(),
    $serverInfo->getMemoryInfo()->getUsedFormated(),
    $serverInfo->getMemoryInfo()->getTotalFormated(),
    100 - $serverInfo->getMemoryInfo()->getFreePercentage(),
);
