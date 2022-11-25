<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Serializer;

use Fschmtt\Keycloak\Serializer\Factory;
use Fschmtt\Keycloak\Serializer\Serializer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Serializer\Factory
 * @uses \Fschmtt\Keycloak\Serializer\ArraySerializer
 * @uses \Fschmtt\Keycloak\Serializer\BooleanSerializer
 * @uses \Fschmtt\Keycloak\Serializer\EnumSerializer
 * @uses \Fschmtt\Keycloak\Serializer\IntegerSerializer
 * @uses \Fschmtt\Keycloak\Serializer\MapSerializer
 * @uses \Fschmtt\Keycloak\Serializer\RepresentationSerializer
 * @uses \Fschmtt\Keycloak\Serializer\Serializer
 * @uses \Fschmtt\Keycloak\Serializer\StringSerializer
 */
class FactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $serializer = (new Factory())->create();

        static::assertInstanceOf(
            Serializer::class,
            $serializer
        );
    }
}
