<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @dataProvider provideCategories
     */
    public function testCreatesExpectedCategory(string $providedCategory, string $expectedCategory): void
    {
        static::assertInstanceOf(
            $expectedCategory,
            Category::from($providedCategory)
        );

        static::assertEquals(
            $providedCategory,
            (string) Category::from($providedCategory)
        );
    }

    public function provideCategories(): array
    {
        return [
            ['ACCESS', CategoryAccess::class],
            ['ADMIN', CategoryAdmin::class],
            ['AUTHORIZATION_RESPONSE', CategoryAuthorizationResponse::class],
            ['ID', CategoryId::class],
            ['INTERNAL', CategoryInternal::class],
            ['LOGOUT', CategoryLogout::class],
            ['USERINFO', CategoryUserinfo::class],
        ];
    }
}
