<?php

namespace Fschmtt\Keycloak\Test\Unit\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantType\ClientCredentials;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use JsonException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

#[CoversClass(ClientCredentials::class)]
class ClientCredentialsTest extends TestCase
{
    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws Exception
     */
    public function testFetchTokens(): void
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->expects(static::once())
            ->method('request')
            ->willReturnOnConsecutiveCalls(
                new Response(
                    status: 200,
                    body: json_encode(
                        value: [
                            'access_token' => 'mockedAccessToken',
                            'refresh_token' => null,
                        ],
                        flags: JSON_THROW_ON_ERROR,
                    ),
                ),
            );

        $clientCredentials = new ClientCredentials('clientId', 'clientSecret');
        $tokens = $clientCredentials->fetchTokens($httpClient, '');

        static::assertSame(
            [
                'access_token' => 'mockedAccessToken',
                'refresh_token' => null,
            ],
            $tokens,
        );
    }
}
