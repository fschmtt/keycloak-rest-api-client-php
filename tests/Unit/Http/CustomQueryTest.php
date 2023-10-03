<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use Fschmtt\Keycloak\Http\CustomQuery;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Representation\User;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CustomQuery::class)]
class CustomQueryTest extends TestCase
{
    public function testCustomCommandWithoutReturnType(): void
    {
        $customQuery = new CustomQuery(
            '/path/to/resource',
        );

        static::assertSame('/path/to/resource', $customQuery->getPath());
        static::assertEquals(Method::GET, $customQuery->getMethod());
        static::assertSame('array', $customQuery->getReturnType());
    }

    public function testCustomCommandWithRepresentationReturnType(): void
    {
        $customQuery = new CustomQuery(
            '/path/to/resource',
            returnType: User::class,
        );

        static::assertSame('/path/to/resource', $customQuery->getPath());
        static::assertEquals(Method::GET, $customQuery->getMethod());
        static::assertSame(User::class, $customQuery->getReturnType());
    }
}
