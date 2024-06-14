<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use Fschmtt\Keycloak\Http\Client;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Http\Query;
use Fschmtt\Keycloak\Http\QueryExecutor;
use Fschmtt\Keycloak\Serializer\Serializer;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(QueryExecutor::class)]
class QueryExecutorTest extends TestCase
{
    public function testCallsClientWithQueryProperties(): void
    {
        $client = $this->createMock(Client::class);
        $client->expects(static::once())
            ->method('request')
            ->with(Method::GET->value, '/path/to/resource')
            ->willReturn(new Response(body: json_encode([], JSON_THROW_ON_ERROR)));

        $executor = new QueryExecutor($client, $this->createMock(Serializer::class));
        $executor->executeQuery(
            new Query(
                '/path/to/resource',
                'array',
            ),
        );
    }

    public function testDecodesArrayReturnType(): void
    {
        $client = $this->createMock(Client::class);
        $client->expects(static::once())
            ->method('request')
            ->with(Method::GET->value, '/path/to/resource')
            ->willReturn(new Response(body: json_encode([], JSON_THROW_ON_ERROR)));

        $serializer = $this->createMock(Serializer::class);
        $serializer->expects(static::never())
            ->method('deserialize');

        $executor = new QueryExecutor($client, $serializer);
        $executor->executeQuery(
            new Query(
                '/path/to/resource',
                'array',
            ),
        );
    }

    public function testDeserializesNonArrayReturnType(): void
    {
        $client = $this->createMock(Client::class);
        $client->expects(static::once())
            ->method('request')
            ->with(Method::GET->value, '/path/to/resource')
            ->willReturn(new Response(body: json_encode([], JSON_THROW_ON_ERROR)));

        $serializer = $this->createMock(Serializer::class);
        $serializer->expects(static::once())
            ->method('deserialize')
            ->with(Client::class, '[]');

        $executor = new QueryExecutor($client, $serializer);
        $executor->executeQuery(
            new Query(
                '/path/to/resource',
                Client::class,
            ),
        );
    }
}
