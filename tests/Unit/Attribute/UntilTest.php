<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Attribute;

use Fschmtt\Keycloak\Attribute\Until;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Until::class)]
class UntilTest extends TestCase
{
    public function testCanBeConstructedWithVersion(): void
    {
        $until = new Until('20.0.0');

        static::assertSame('20.0.0', $until->version);
    }
}
