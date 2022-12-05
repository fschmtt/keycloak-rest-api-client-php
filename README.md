![PHP Analysis](https://github.com/fschmtt/keycloak-rest-api-client-php/actions/workflows/php-analysis.yml/badge.svg?branch=main)
![PHP Unit](https://github.com/fschmtt/keycloak-rest-api-client-php/actions/workflows/php-unit.yml/badge.svg?branch=main)
![PHP Integration (Keycloak compatibility)](https://github.com/fschmtt/keycloak-rest-api-client-php/actions/workflows/php-integration.yml/badge.svg?branch=main)
![PHP Legacy (Keycloak compatibility)](https://github.com/fschmtt/keycloak-rest-api-client-php/actions/workflows/php-integration-legacy.yml/badge.svg?branch=main)

# Keycloak Admin REST API Client
PHP client to interact with [Keycloak's Admin REST API](https://www.keycloak.org/docs-api/20.0.0/rest-api/index.html).

Inspired by [keycloak/keycloak-nodejs-admin-client](https://github.com/keycloak/keycloak-nodejs-admin-client).

_Note: This library is WIP and can not be considered stable yet - do not use this in production._

## Installation
Install via Composer:
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
Keycloak 20.0.0 is running on Linux/5.10.25-linuxkit (amd64) with OpenJDK 64-Bit Server VM/11.0.11 since 0 days, 2 hours, 37 minutes, 7 seconds and is currently using 139 MB of 512 MB (28 %) memory.
```

More examples can be found in the [examples](examples) directory.

## Available Resources
### [Attack Detection](https://www.keycloak.org/docs-api/20.0.0/rest-api/index.html#_attack_detection_resource)
| Endpoint | Status Code | Response | API |
|----------|-------------|----------|-----|
| `DELETE /auth/admin/realms/{realm}/attack-detection/brute-force/users` | `204` | `n/a` | [AttackDetection::clear()](src/Resource/AttackDetection.php) |
| `GET /auth/admin/realms/{realm}/attack-detection/brute-force/users/{userId}` | `204` | [Map](src/Type/Map.php) | [AttackDetection::userStatus()](src/Resource/AttackDetection.php) |
| `DELETE /auth/admin/realms/{realm}/attack-detection/brute-force/users/{userId}` | `204` | `n/a` | [AttackDetection::clearUser()](src/Resource/AttackDetection.php) |

### [Realms Admin](https://www.keycloak.org/docs-api/20.0.0/rest-api/index.html#_realms_admin_resource)
| Endpoint | Status Code | Response | API |
|----------|-------------|----------|-----|
| `POST /auth/admin/realms` | `201` | [Realm](src/Representation/Realm.php) | [Realms::import()](src/Resource/Realms.php) |
| `GET /auth/admin/realms` | `200` | [RealmCollection](src/Collection/RealmCollection.php) | [Realms::all()](src/Resource/Realms.php) |
| `PUT /auth/admin/realms/{realm}` | `204` | [Realm](src/Representation/Realm.php) | [Realms::update()](src/Resource/Realms.php) |
| `DELETE /auth/admin/realms/{realm}` | `204` | `n/a` | [Realms::delete()](src/Resource/Realms.php) |
| `GET /auth/admin/realms/{realm}/admin-events` | `200` | `array` | [Realms::adminEvents()](src/Resource/Realms.php) |
| `DELETE /auth/admin/realms/{realm}/admin-events` | `204` | `n/a` | [Realms::deleteAdminEvents()](src/Resource/Realms.php) |
| `POST /auth/admin/realms/{realm}/clear-keys-cache` | `204` | `n/a` | [Realms::clearKeysCache()](src/Resource/Realms.php) |
| `POST /auth/admin/realms/{realm}/clear-realm-cache` | `204` | `n/a` | [Realms::clearRealmCache()](src/Resource/Realms.php) |
| `POST /auth/admin/realms/{realm}/clear-user-cache` | `204` | `n/a` | [Realms::clearUserCache()](src/Resource/Realms.php) |
| `GET /auth/admin/realms/{realm}/clients` | `200` | [ClientCollection](src/Collection/ClientCollection.php) | [Realms::clients()](src/Resource/Realms.php) |
| `GET /auth/admin/realms/{realm}/users` | `200` | [UserCollection](src/Collection/UserCollection.php) | [Realms::users()](src/Resource/Realms.php) |

### [Root](https://www.keycloak.org/docs-api/20.0.0/rest-api/index.html#_root_resource)
| Endpoint | Status Code | Response | API |
|----------|-------------|----------|-----|
| `GET /auth/admin/serverinfo` | `200` | [ServerInfo](src/Representation/ServerInfo.php) | [ServerInfo::get()](src/Resource/ServerInfo.php) |

## Local development and testing
Run `docker compose up -d keycloak` to start a local Keycloak instance listening on http://localhost:8080.

Run your script (e.g. [examples/serverinfo.php](examples/serverinfo.php)) from within the `php` container:
```bash
docker compose run --rm php php examples/serverinfo.php
```

### Composer scripts
* `analyze`: Run phpstan and psalm analysis
* `ecs`: Run Easy Coding Standard (ECS)
* `ecs:fix`: Fix Easy Coding Standard (ECS) errors
* `test`: Run unit and integration tests
* `test:unit`: Run unit tests
* `test:integration`: Run integration tests (requires a fresh and running Keycloak instance)
