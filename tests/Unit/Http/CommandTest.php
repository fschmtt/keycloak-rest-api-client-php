<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Test\Unit\Stub\Representation;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Http\Command
 */
class CommandTest extends TestCase
{
    public function testHasNoRepresentationByDefault(): void
    {
        static::assertNull((new Command('/path', Method::POST))->getRepresentation());
    }

    public function testCanGetRepresentation(): void
    {
        $representation = new Representation();

        static::assertSame(
            $representation,
            (new Command('/path', Method::POST, [], $representation))->getRepresentation()
        );
    }

    public function testSubstitutesParametersInPath(): void
    {
        static::assertSame(
            '/admin/realms/master/groups?briefRepresentation=true',
            (new Command(
                '/admin/realms/{realm}/groups?briefRepresentation={briefRepresentation}',
                Method::GET,
                [
                    'realm' => 'master',
                    'briefRepresentation' => true,
                ]
            ))->getPath()
        );
    }

    public function testSupportsAnyMethod(): void
    {
        foreach (Method::cases() as $method) {
            static::assertSame(
                $method->value,
                (new Command('/path', $method))->getMethod()->value
            );
        }
    }
}
