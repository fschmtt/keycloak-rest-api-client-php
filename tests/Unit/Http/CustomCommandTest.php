<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use Fschmtt\Keycloak\Http\CustomCommand;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Test\Unit\Stub\Representation;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CustomCommand::class)]
class CustomCommandTest extends TestCase
{
    public function testCustomCommandWithoutPayload(): void
    {
        $customCommand = new CustomCommand(
            '/path/to/resource',
            Method::PUT,
        );

        static::assertSame('/path/to/resource', $customCommand->getPath());
        static::assertSame(Method::PUT, $customCommand->getMethod());
        static::assertNull($customCommand->getPayload());
    }

    public function testCustomCommandWithRepresentationPayload(): void
    {
        $representation = new Representation();

        $customCommand = new CustomCommand(
            '/path/to/resource',
            Method::PUT,
            $representation,
        );

        static::assertSame('/path/to/resource', $customCommand->getPath());
        static::assertSame(Method::PUT, $customCommand->getMethod());
        static::assertSame($representation, $customCommand->getPayload());
    }
}
