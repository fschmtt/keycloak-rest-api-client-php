<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\Resource\AttackDetection;
use Fschmtt\Keycloak\Type\Map;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AttackDetection::class)]
class AttackDetectionTest extends TestCase
{
    public function testClearAttackDetectionForAllUsersInRealm(): void
    {
        $command = new Command(
            '/admin/realms/{realm}/attack-detection/brute-force/users',
            Method::DELETE,
            [
                'realm' => 'realm',
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $attackDetection = new AttackDetection(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );
        $attackDetection->clear('realm');
    }

    public function testClearAttackDetectionForSingleUserInRealm(): void
    {
        $command = new Command(
            '/admin/realms/{realm}/attack-detection/brute-force/users/{userId}',
            Method::DELETE,
            [
                'realm' => 'realm',
                'userId' => 'userId',
            ],
        );

        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with($command);

        $attackDetection = new AttackDetection(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
        );
        $attackDetection->clearUser('realm', 'userId');
    }

    public function testGetAttackDetectionForSingleUserInRealm(): void
    {
        $query = new Query(
            '/admin/realms/{realm}/attack-detection/brute-force/users/{userId}',
            Map::class,
            [
                'realm' => 'realm',
                'userId' => 'userId',
            ],
        );

        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with($query)
            ->willReturn(new Map());

        $attackDetection = new AttackDetection(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
        );
        $attackDetection->userStatus('realm', 'userId');
    }
}
