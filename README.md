# Keycloak REST API Client
PHP client to interact with [Keycloak's Admin REST API](https://www.keycloak.org/docs-api/13.0/rest-api/index.html).

Inspired by [keycloak/keycloak-nodejs-admin-client](https://github.com/keycloak/keycloak-nodejs-admin-client).

_Note: This library is WIP can not be considered stable yet - do not use this in production._

## Installation
Install via composer:
```bash
composer require fschmtt/keycloak-rest-api-client-php
```

## Usage
Example:

```php 
$keycloak = new \Fschmtt\Keycloak\Keycloak(
    baseUrl: 'http://keycloak:8080',
    username: 'admin',
    password: 'admin'
);

$serverInfo = $keycloak->serverInfo()->get();

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
```
will print e.g.
```text
Keycloak 13.0.0 is running on Linux/5.10.25-linuxkit (amd64) with OpenJDK 64-Bit Server VM/11.0.11 since 0 days, 2 hours, 37 minutes, 7 seconds and is currently using 139 MB of 512 MB (28 %) memory.
```

More examples can be found in the [examples](examples) directory.

## Local development and testing
Run `docker compose up -d` to start a local Keycloak instance listening on http://localhost:8080.

Run your script (e. g. [examples/serverinfo.php](examples/serverinfo.php)) from within the `php` container:
```bash
docker compose run --rm php php examples/serverinfo.php
```

### Make targets
`test`: Run PHPUnit tests

`analyze`: Run phpstan and psalm analysis

`sniff`: Run PHP_CodeSniffer

`fix-cs`: Fix code style