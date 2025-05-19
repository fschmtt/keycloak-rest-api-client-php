<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\ContentType;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Json\JsonEncoder;
use Fschmtt\Keycloak\Serializer\Serializer;
use Fschmtt\Keycloak\Test\Unit\Stub\Collection;
use Fschmtt\Keycloak\Test\Unit\Stub\Representation;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CommandExecutor::class)]
class CommandExecutorTest extends TestCase
{
    public function testCallsClientWithoutBodyIfCommandHasNoRepresentation(): void
    {
        $client = $this->createMock(Client::class);
        $client->expects(static::once())
            ->method('request')
            ->with(
                Method::DELETE->value,
                '/path/to/resource',
                [
                    'body' => null,
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                ],
            );

        $executor = new CommandExecutor($client, new Serializer());
        $executor->executeCommand(
            new Command(
                '/path/to/resource',
                Method::DELETE,
            ),
        );
    }

    public function testCallsClientWithJsonIfCommandHasRepresentation(): void
    {
        $command = new Command(
            '/path/to/resource',
            Method::PUT,
            [],
            new Representation(),
        );
        $payload = $command->getPayload();
        static::assertInstanceOf(Representation::class, $payload);

        $client = $this->createMock(Client::class);
        $client->expects(static::once())
            ->method('request')
            ->with(
                Method::PUT->value,
                '/path/to/resource',
                [
                    'body' => (new JsonEncoder())->encode($payload->jsonSerialize()),
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                ],
            );

        $executor = new CommandExecutor($client, new Serializer());
        $executor->executeCommand($command);
    }

    public function testCallsClientWithBodyIfCommandHasCollection(): void
    {
        $representation = new Representation();

        $command = new Command(
            '/path/to/resource',
            Method::PUT,
            [],
            new Collection([$representation]),
        );

        $client = $this->createMock(Client::class);
        $client->expects(static::once())
            ->method('request')
            ->with(
                Method::PUT->value,
                '/path/to/resource',
                [
                    'body' => (new JsonEncoder())->encode([$representation->jsonSerialize()]),
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                ],
            );

        $executor = new CommandExecutor($client, new Serializer());
        $executor->executeCommand($command);
    }

    public function testCallsClientWithFormParamsIfCommandFormParamContentType(): void
    {
        $command = new Command(
            '/path/to/resource',
            Method::PUT,
            [],
            $payload = ['UPDATE_PASSWORD', 'VERIFY_EMAIL'],
            contentType: ContentType::FORM_PARAMS,
        );

        $client = $this->createMock(Client::class);
        $client->expects(static::once())
            ->method('request')
            ->with(
                Method::PUT->value,
                '/path/to/resource',
                [
                    'form_params' => $payload,
                ],
            );

        $executor = new CommandExecutor($client, new Serializer());
        $executor->executeCommand($command);
    }

    public function testCallsClientWithUnserializedStringAsBodyIfPayloadIsString(): void
    {
        $command = new Command(
            '/path/to/resource',
            Method::PUT,
            [],
            $payload = 'string',
        );

        $client = $this->createMock(Client::class);
        $client->expects(static::once())
            ->method('request')
            ->with(
                Method::PUT->value,
                '/path/to/resource',
                [
                    'body' => $payload,
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                ],
            );

        $executor = new CommandExecutor($client, new Serializer());
        $executor->executeCommand($command);
    }
}
