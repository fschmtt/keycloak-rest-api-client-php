<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Type\Map;

class AttackDetection extends Resource
{
    public function clear(string $realm): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/attack-detection/brute-force/users',
                Method::DELETE,
                [
                    'realm' => $realm,
                ]
            )
        );
    }

    public function userStatus(string $realm, string $userId): Map
    {
        return $this->queryExecutor->executeQuery(
            new Query(
                '/admin/realms/{realm}/attack-detection/brute-force/users/{userId}',
                Map::class,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ]
            )
        );
    }

    public function clearUser(string $realm, string $userId): void
    {
        $this->commandExecutor->executeCommand(
            new Command(
                '/admin/realms/{realm}/attack-detection/brute-force/users/{userId}',
                Method::DELETE,
                [
                    'realm' => $realm,
                    'userId' => $userId,
                ]
            )
        );
    }
}
