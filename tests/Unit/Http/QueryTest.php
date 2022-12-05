<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Http\Query
 */
class QueryTest extends TestCase
{
    public function testEnforcesGetMethod(): void
    {
        static::assertSame(
            Method::GET->value,
            (new Query('', ''))->getMethod()->value
        );
    }

    public function testSubstitutesParametersInPath(): void
    {
        static::assertSame(
            '/admin/realms/master/groups?briefRepresentation=true',
            (new Query(
                '/admin/realms/{realm}/groups?briefRepresentation={briefRepresentation}',
                GroupCollection::class,
                [
                    'realm' => 'master',
                    'briefRepresentation' => true,
                ]
            ))->getPath()
        );
    }

    public function testGetReturnType(): void
    {
        static::assertSame(
            GroupCollection::class,
            (new Query(
                '/admin/realms/{realm}/groups?briefRepresentation={briefRepresentation}',
                GroupCollection::class,
                [
                    'realm' => 'master',
                    'briefRepresentation' => true,
                ]
            ))->getReturnType()
        );
    }
}
