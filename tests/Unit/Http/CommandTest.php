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
    public function testHasNoPayloadByDefault(): void
    {
        static::assertNull((new Command('/path', Method::POST))->getPayload());
    }

    public function testCanGetPayload(): void
    {
        $representation = new Representation();

        static::assertSame(
            $representation,
            (new Command('/path', Method::POST, [], $representation))->getPayload()
        );
    }

    public function testCanGetPayloadWithArray(): void
    {
        $payload = [new Representation()];

        static::assertSame(
            $payload,
            (new Command('/path', Method::POST, [], $payload))->getPayload()
        );
    }

    public function testInvalidPayloadThrowsException(): void
    {
        $this->expectException(\TypeError::class);
        /** @psalm-suppress InvalidArgument */
        new Command('/path', Method::POST, [], [1, 2, 3]);
    }

    public function testSubstitutesParametersInPath(): void
    {
        static::assertSame(
            '/admin/realms/master/groups/group-uuid',
            (new Command(
                '/admin/realms/{realm}/groups/{groupId}',
                Method::GET,
                [
                    'realm' => 'master',
                    'groupId' => 'group-uuid',
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
