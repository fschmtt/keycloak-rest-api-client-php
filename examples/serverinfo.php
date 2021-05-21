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
    echo sprintf(
        'Password policy "%s" does %s support multiple%s',
        $passwordPolicy->getDisplayName(),
        $passwordPolicy->getMultipleSupported() ? '' : 'not',
        PHP_EOL,
    );
}

echo sprintf(
    'Keycloak %s is running on %s/%s (%s) with %s/%s since %s and currently using %s of %s memory.%s',
    $serverInfo->getSystemInfo()->getVersion(),
    $serverInfo->getSystemInfo()->getOsName(),
    $serverInfo->getSystemInfo()->getOsVersion(),
    $serverInfo->getSystemInfo()->getOsArchitecture(),
    $serverInfo->getSystemInfo()->getJavaVm(),
    $serverInfo->getSystemInfo()->getJavaVersion(),
    $serverInfo->getSystemInfo()->getUptime(),
    $serverInfo->getMemoryInfo()->getUsedFormated(),
    $serverInfo->getMemoryInfo()->getTotalFormated(),
    PHP_EOL,
);

$serverInfo2 = $serverInfo->withBuiltinProtocolMappers(null);
var_dump($serverInfo2->getBuiltinProtocolMappers());
