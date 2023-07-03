<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Attribute;

use Fschmtt\Keycloak\Attribute\Since;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Since::class)]
class SinceTest extends TestCase
{
    public function testCanBeConstructedWithVersion(): void
    {
        $since = new Since('20.0.0');

        static::assertSame('20.0.0', $since->version);
    }
}
