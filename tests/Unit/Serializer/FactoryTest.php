<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testCreate()
    {
        $serializer = (new Factory())->create();

        static::assertInstanceOf(
            Serializer::class,
            $serializer
        );
    }
}
