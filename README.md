# Keycloak REST API Client
PHP client to interact with [Keycloak's Admin REST API](https://www.keycloak.org/docs-api/13.0/rest-api/index.html).

_Note: This library is WIP can not be considered stable yet - do not use this in production._

## Installation
*tbd*

## Local development and testing
Run `docker compose up -d` to start a local Keycloak instance listening on http://localhost:8080.

Run your script (e. g. [examples/serverinfo.php](examples/serverinfo.php)) from within the `php` container:
```bash
docker compose run php php examples/serverinfo.php
```

### Make targets
`test`: Run PHPUnit tests

`analyze`: Run phpstan and psalm analysis

`sniff`: Run PHP_CodeSniffer

`fix-cs`: Fix code style