<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Resource;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Http\CommandExecutor;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\CustomCommand;
use Fschmtt\Keycloak\Http\CustomQuery;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\Resource\Custom;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Custom::class)]
class CustomTest extends TestCase
{
    public function testRunsCustomQuery(): void
    {
        $queryExecutor = $this->createMock(QueryExecutor::class);
        $queryExecutor->expects(static::once())
            ->method('executeQuery')
            ->with(new CustomQuery(
                '/admin/my/custom-endpoint',
                new Criteria([
                    'foo' => 'bar',
                ]),
            ))
            ->willReturn([
                'return' => 'value',
            ]);

        $custom = new Custom(
            $this->createMock(CommandExecutor::class),
            $queryExecutor,
            $this->createMock(Client::class),
        );

        $result = $custom->query(new CustomQuery(
            '/admin/my/custom-endpoint',
            new Criteria([
                'foo' => 'bar',
            ]),
        ));

        static::assertSame([
            'return' => 'value',
        ], $result);
    }

    public function testRunsCustomCommand(): void
    {
        $commandExecutor = $this->createMock(CommandExecutor::class);
        $commandExecutor->expects(static::once())
            ->method('executeCommand')
            ->with(new CustomCommand(
                '/admin/my/custom-endpoint',
                Method::POST,
                [
                    'foo' => 'bar',
                ],
            ));

        $custom = new Custom(
            $commandExecutor,
            $this->createMock(QueryExecutor::class),
            $this->createMock(Client::class),
        );

        $custom->command(new CustomCommand(
            '/admin/my/custom-endpoint',
            Method::POST,
            [
                'foo' => 'bar',
            ],
        ));
    }

    public function testRunsCustomRequest(): void
    {
        $client = $this->createMock(Client::class);
        $client->expects(static::once())
            ->method('request')
            ->with(
                'POST',
                '/admin/my/custom-endpoint',
                [
                    'headers' => [
                        'Custom-Header' => 'custom-value',
                    ],
                ],
            )
            ->willReturn(new Response(
                200,
                [],
                json_encode([
                    'return' => 'value',
                ]),
            ));

        $custom = new Custom(
            $this->createMock(CommandExecutor::class),
            $this->createMock(QueryExecutor::class),
            $client,
        );

        $response = $custom->request(
            'POST',
            '/admin/my/custom-endpoint',
            [
                'headers' => [
                    'Custom-Header' => 'custom-value',
                ],
            ]
        );

        static::assertSame(200, $response->getStatusCode());
    }
}
