# Keycloak REST API Client
PHP client to interact with [Keycloak's Admin REST API](https://www.keycloak.org/docs-api/13.0/rest-api/index.html).

Inspired by [keycloak/keycloak-nodejs-admin-client](https://github.com/keycloak/keycloak-nodejs-admin-client).

_Note: This library is WIP can not be considered stable yet - do not use this in production._

## Installation
Install via Composer:
```bash
composer require fschmtt/keycloak-rest-api-client-php
```

## Usage
Example:

```php
use Fschmtt\Keycloak\Keycloak;$keycloak = new Keycloak(
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

## Available Resources
### [Attack Detection](https://www.keycloak.org/docs-api/13.0/rest-api/index.html#_attack_detection_resource)
| Endpoint | Status Code | Response | API |
|----------|-------------|----------|-----|
| `DELETE /auth/admin/realms/{realm}/attack-detection/brute-force/users` | `204` | `n/a` | [AttackDetection::clear()](src/Resource/AttackDetection.php) |

### [Realms Admin](https://www.keycloak.org/docs-api/13.0/rest-api/index.html#_realms_admin_resource)
| Endpoint | Status Code | Response | API |
|----------|-------------|----------|-----|
| `POST /auth/admin/realms` | `201` | [Realm](src/Representation/Realm.php) | [Realms::import()](src/Resource/Realms.php) |
| `GET /auth/admin/realms` | `200` | array<[Realm](src/Representation/Realm.php)> | [Realms::all()](src/Resource/Realms.php) |
| `PUT /auth/admin/realms/{realm}` | `204` | [Realm](src/Representation/Realm.php) | [Realms::update()](src/Resource/Realms.php) |

### [Root](https://www.keycloak.org/docs-api/13.0/rest-api/index.html#_root_resource)
| Endpoint | Status Code | Response | API |
|----------|-------------|----------|-----|
| `GET /auth/admin/serverinfo` | `200` | [ServerInfo](src/Representation/ServerInfo.php) | [ServerInfo::get()](src/Resource/ServerInfo.php) |

## Local development and testing
Run `docker compose up -d` to start a local Keycloak instance listening on http://localhost:8080.

Run your script (e. g. [examples/serverinfo.php](examples/serverinfo.php)) from within the `php` container:
```bash
docker compose run --rm php php examples/serverinfo.php
```

### Make targets
`test`: Run PHPUnit tests

`analyze`: Run phpstan and Psalm analysis

`sniff`: Run PHP_CodeSniffer

`fix-cs`: Fix code style
