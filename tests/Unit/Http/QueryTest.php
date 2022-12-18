<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Http\Criteria;
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
            '/admin/realms/master/groups/group-uuid',
            (new Query(
                '/admin/realms/{realm}/groups/{groupId}',
                GroupCollection::class,
                [
                    'realm' => 'master',
                    'groupId' => 'group-uuid',
                ]
            ))->getPath()
        );
    }

    public function testGetReturnType(): void
    {
        static::assertSame(
            GroupCollection::class,
            (new Query(
                '/admin/realms/{realm}/groups',
                GroupCollection::class,
                [
                    'realm' => 'master',
                ]
            ))->getReturnType()
        );
    }

    public function testBuildsPathWithQueryIfCriteriaIsProvided(): void
    {
        static::assertSame(
            '/admin/realms/master/groups?username=foo&exact=true',
            (new Query(
                '/admin/realms/{realm}/groups',
                GroupCollection::class,
                [
                    'realm' => 'master',
                ],
                new Criteria([
                    'username' => 'foo',
                    'exact' => true,
                ])
            ))->getPath()
        );
    }

    public function testBuildsPathWithoutQueryIfCriteriaIsNotProvided(): void
    {
        static::assertSame(
            '/admin/realms/master/groups',
            (new Query(
                '/admin/realms/{realm}/groups',
                GroupCollection::class,
                [
                    'realm' => 'master',
                ],
            ))->getPath()
        );
    }
}
