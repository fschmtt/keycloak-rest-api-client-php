Forked from [fschmtt/keycloak-rest-api-client-php](https://github.com/fschmtt/keycloak-rest-api-client-php).
This repository has been modified to allow getting credentials for any client, not just the admin client.

[![codecov](https://codecov.io/gh/fschmtt/keycloak-rest-api-client-php/graph/badge.svg?token=uDlQdqBF5V)](https://codecov.io/gh/fschmtt/keycloak-rest-api-client-php)
![PHP Analysis](https://github.com/fschmtt/keycloak-rest-api-client-php/actions/workflows/php-analysis.yml/badge.svg?branch=main)
![PHP Unit](https://github.com/fschmtt/keycloak-rest-api-client-php/actions/workflows/php-unit.yml/badge.svg?branch=main)
![PHP Integration (Keycloak compatibility)](https://github.com/fschmtt/keycloak-rest-api-client-php/actions/workflows/php-integration.yml/badge.svg?branch=main)
![PHP Legacy (Keycloak compatibility)](https://github.com/fschmtt/keycloak-rest-api-client-php/actions/workflows/php-integration-legacy.yml/badge.svg?branch=main)

# Keycloak Admin REST API Client
PHP client to interact with [Keycloak's Admin REST API](https://www.keycloak.org/docs-api/23.0.0/rest-api/index.html).

Inspired by [keycloak/keycloak-nodejs-admin-client](https://github.com/keycloak/keycloak-nodejs-admin-client).

## Installation
Install via Composer:
```bash
composer require castoredc/keycloak-rest-api-client-php
```

## Usage
Example:

```php
$keycloak = new \Fschmtt\Keycloak\Keycloak(
    baseUrl: 'http://keycloak:8080',
    username: 'admin',
    password: 'admin',
    realm: 'master' # optional, defaults to 'master'
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
Keycloak 23.0.0 is running on Linux/5.10.25-linuxkit (amd64) with OpenJDK 64-Bit Server VM/11.0.11 since 0 days, 2 hours, 37 minutes, 7 seconds and is currently using 139 MB of 512 MB (28 %) memory.
```

More examples can be found in the [examples](examples) directory.

## Customization

### Custom representations & resources

You can register and use custom resources by providing your own representations and resources, e.g.:
```php
class MyCustomRepresentation extends \Fschmtt\Keycloak\Representation\Representation
{
    public function __construct(
        protected ?string $id = null,
        protected ?string $name = null,
    ) {
    }
}

class MyCustomResource extends \Fschmtt\Keycloak\Resource\Resource
{
    public function myCustomEndpoint(): MyCustomRepresentation
    {
        return $this->queryExecutor->executeQuery(
            new \Fschmtt\Keycloak\Http\Query(
                '/my-custom-endpoint',
                MyCustomRepresentation::class,
            )
        );
    }
}
```

By extending the `Resource` class, you have access to both the `QueryExecutor` and `CommandExecutor`.
The `CommandExecutor` is designed to run state-changing commands against the server (without returning a response);
the `QueryExecutor` allows fetching resources and representations from the server.

To use your custom resource, pass the fully-qualified class name (FQCN) to the `Keycloak::resource()` method. It provides you with an instance of your resource you can then work with:
```php
$keycloak = new Keycloak(
    $_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080',
    'admin',
    'admin',
);

$myCustomResource = $keycloak->resource(MyCustomResource::class);
$myCustomRepresentation = $myCustomResource->myCustomEndpoint();
```

## Available Resources
### [Attack Detection](https://www.keycloak.org/docs-api/23.0.0/rest-api/index.html#_attack_detection_resource)
| Endpoint | Response | API |
|----------|----------|-----|
| `DELETE /admin/realms/{realm}/attack-detection/brute-force/users` | `n/a` | [AttackDetection::clear()](src/Resource/AttackDetection.php) |
| `GET /admin/realms/{realm}/attack-detection/brute-force/users/{userId}` | [Map](src/Type/Map.php) | [AttackDetection::userStatus()](src/Resource/AttackDetection.php) |
| `DELETE /admin/realms/{realm}/attack-detection/brute-force/users/{userId}` | `n/a` | [AttackDetection::clearUser()](src/Resource/AttackDetection.php) |

### [Clients](https://www.keycloak.org/docs-api/23.0.0/rest-api/index.html#_clients_resource)
| Endpoint | Response | API |
|----------|----------|-----|
| `GET /admin/realms/{realm}/clients` | [ClientCollection](src/Collection/ClientCollection.php) | [Clients::all()](src/Resource/Clients.php) |
| `GET /admin/realms/{realm}/clients/{id}` | [Client](src/Representation/Client.php) | [Clients::get()](src/Resource/Clients.php) |
| `PUT /admin/realms/{realm}/clients/{id}` | [Client](src/Representation/Client.php) | [Clients::update()](src/Resource/Clients.php) |
| `POST /admin/realms/{realm}/clients` | [Client](src/Representation/Client.php) | [Clients::import()](src/Resource/Clients.php) |

### [Groups](https://www.keycloak.org/docs-api/23.0.0/rest-api/index.html#_clients_resource)
| Endpoint                                          | Response | API                                           |
|---------------------------------------------------|----------|-----------------------------------------------|
| `GET /admin/realms/{realm}/groups`                | [GroupCollection](src/Collection/GroupCollection.php) | [Groups::all()](src/Resource/Groups.php)      |
| `GET /admin/realms/{realm}/groups/{id}/children`  | [GroupCollection](src/Collection/GroupCollection.php) | [Groups::children()](src/Resource/Groups.php) |
| `GET /admin/realms/{realm}/groups/{id}`           | [Group](src/Representation/Group.php) | [Groups::get()](src/Resource/Groups.php)      |
| `PUT /admin/realms/{realm}/groups/{id}`           | `n/a` | [Groups::update()](src/Resource/Groups.php)   |
| `POST /admin/realms/{realm}/groups`               | `n/a` | [Groups::create()](src/Resource/Groups.php)   |
| `POST /admin/realms/{realm}/groups/{id}/children` | `n/a` | [Groups::create()](src/Resource/Groups.php)   |
| `DELETE /admin/realms/{realm}/groups`             | `n/a` | [Groups::delete()](src/Resource/Groups.php)   |

### [Realms Admin](https://www.keycloak.org/docs-api/23.0.0/rest-api/index.html#_realms_admin_resource)
| Endpoint | Response | API |
|----------|----------|-----|
| `POST /admin/realms` | [Realm](src/Representation/Realm.php) | [Realms::import()](src/Resource/Realms.php) |
| `GET /admin/realms` | [RealmCollection](src/Collection/RealmCollection.php) | [Realms::all()](src/Resource/Realms.php) |
| `PUT /admin/realms/{realm}` | [Realm](src/Representation/Realm.php) | [Realms::update()](src/Resource/Realms.php) |
| `DELETE /admin/realms/{realm}` | `n/a` | [Realms::delete()](src/Resource/Realms.php) |
| `GET /admin/realms/{realm}/admin-events` | `array` | [Realms::adminEvents()](src/Resource/Realms.php) |
| `DELETE /admin/realms/{realm}/admin-events` | `n/a` | [Realms::deleteAdminEvents()](src/Resource/Realms.php) |
| `POST /admin/realms/{realm}/clear-keys-cache` | `n/a` | [Realms::clearKeysCache()](src/Resource/Realms.php) |
| `POST /admin/realms/{realm}/clear-realm-cache` | `n/a` | [Realms::clearRealmCache()](src/Resource/Realms.php) |
| `POST /admin/realms/{realm}/clear-user-cache` | `n/a` | [Realms::clearUserCache()](src/Resource/Realms.php) |

### [Users](https://www.keycloak.org/docs-api/23.0.0/rest-api/index.html#_users_resource)
| Endpoint | Response | API |
|----------|----------|-----|
| `GET /admin/realms/{realm}/users` | [UserCollection](src/Collection/UserCollection.php) | [Users::all()](src/Resource/Users.php) |
| `POST /admin/realms/{realm}/users` | `n/a` | [Users::create()](src/Resource/Users.php) |
| `GET /admin/realms/{realm}/users/{userId}` | [User](src/Representation/User.php) | [Users::get()](src/Resource/Users.php) |
| `PUT /admin/realms/{realm}/users/{userId}` | `n/a` | [Users::update()](src/Resource/Users.php) |
| `DELETE /admin/realms/{realm}/users/{userId}` | `n/a` | [Users::delete()](src/Resource/Users.php) |
| `GET /admin/realms/{realm}/users` | [UserCollection](src/Collection/UserCollection.php) | [Users::search()](src/Resource/Users.php) |
| `PUT /{realm}/users/{id}/groups/{groupId}` | `n/a` | [Users::joinGroup()](src/Resource/Users.php) |
| `DELETE /{realm}/users/{id}/groups/{groupId}` | `n/a` | [Users::leaveGroup()](src/Resource/Users.php) |
| `GET /{realm}/users/{id}/groups` | [GroupCollection](src/Collection/GroupCollection.php) | [Users::retrieveGroups()](src/Resource/Users.php) |
| `GET /{realm}/users/{id}/role-mappings/realm` | [RoleCollection](src/Collection/RoleCollection.php) | [Users::retrieveRealmRoles()](src/Resource/Users.php) |
| `GET /{realm}/users/{id}/role-mappings/realm/available` | [RoleCollection](src/Collection/RoleCollection.php) | [Users::retrieveAvailableRealmRoles()](src/Resource/Users.php) |
| `POST /{realm}/users/{id}/role-mappings/realm` | `n/a` | [Users::addRealmRoles()](src/Resource/Users.php) |
| `DELETE /{realm}/users/{id}/role-mappings/realm` | `n/a` | [Users::removeRealmRoles()](src/Resource/Users.php) |
| `PUT /{realm}/users/{id}/execute-actions-email` | `n/a` | [Users::executeActionsEmail()](src/Resource/Users.php) |

### [Roles](https://www.keycloak.org/docs-api/23.0.0/rest-api/index.html#_roles_resource)
| Endpoint | Response | API |
|----------|----------|-----|
| `GET /admin/realms/{realm}/roles` | [RoleCollection](src/Collection/RoleCollection.php) | [Roles::all()](src/Resource/Roles.php) |
| `GET /admin/realms/{realm}/roles/{roleName}` | [Role](src/Representation/Role.php) | [Roles::get()](src/Resource/Roles.php) |
| `POST /admin/realms/{realm}/roles` | `n/a` | [Roles::create()](src/Resource/Roles.php) |
| `DELETE /admin/realms/{realm}/roles/{roleName}` | `n/a` | [Roles::delete()](src/Resource/Roles.php) |

### [Root](https://www.keycloak.org/docs-api/23.0.0/rest-api/index.html#_root_resource)
| Endpoint | Response | API |
|----------|----------|-----|
| `GET /admin/serverinfo` | [ServerInfo](src/Representation/ServerInfo.php) | [ServerInfo::get()](src/Resource/ServerInfo.php) |

## Local development and testing
Run `docker compose up -d keycloak` to start a local Keycloak instance listening on http://localhost:8080.

Run your script (e.g. [examples/serverinfo.php](examples/serverinfo.php)) from within the `php` container:
```bash
docker compose run --rm php php examples/serverinfo.php
```

### Composer scripts
* `analyze`: Run phpstan analysis
* `ecs`: Run Easy Coding Standard (ECS)
* `ecs:fix`: Fix Easy Coding Standard (ECS) errors
* `test`: Run unit and integration tests
* `test:unit`: Run unit tests
* `test:integration`: Run integration tests (requires a fresh and running Keycloak instance)
