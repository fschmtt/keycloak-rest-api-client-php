<?php

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new \Fschmtt\Keycloak\Keycloak(
    'http://keycloak:8080',
    'admin',
    'admin'
);

$serverInfo = $keycloak->getServerInfo();

/** @var \Fschmtt\Keycloak\Representation\PasswordPolicyType $passwordPolicy */
foreach ($serverInfo->getPasswordPolicies() as $passwordPolicy) {
    var_dump($passwordPolicy->getMultipleSupported());
}

echo sprintf(
    'Keycloak is currently using %s of %s memory.',
    $serverInfo->getMemoryInfo()->getUsedFormatted(),
    $serverInfo->getMemoryInfo()->getTotalFormatted()
);
