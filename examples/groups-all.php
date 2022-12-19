<?php

declare(strict_types=1);

use Fschmtt\Keycloak\Keycloak;
use Fschmtt\Keycloak\Representation\Group;

require_once __DIR__ . '/../vendor/autoload.php';

$keycloak = new Keycloak(
    baseUrl: 'http://keycloak:8080',
    username: 'admin',
    password: 'admin',
);

$realm = 'master';
$groups = $keycloak->groups()->all($realm);

echo sprintf('Realm "%s" has the following groups:%s', $realm, PHP_EOL);

foreach ($groups as $group) {
    echoGroup($group);
}

function echoGroup(Group $group, int $level = 1): void
{
    echo sprintf('%s> Group "%s"%s', str_repeat('-', $level), $group->getName(), PHP_EOL);

    foreach ($group->getSubGroups() as $group) {
        echoGroup($group, $level + 1);
    }
}
