<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Serializer\Factory;
use Fschmtt\Keycloak\Serializer\Serializer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Factory::class)]
class FactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $serializer = (new Factory())->create();

        static::assertInstanceOf(
            Serializer::class,
            $serializer,
        );
    }
}
