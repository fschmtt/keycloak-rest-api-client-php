<?php

namespace Fschmtt\Keycloak\Test\Unit\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantType\Password;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use JsonException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

#[CoversClass(Password::class)]
class PasswordTest extends TestCase
{
    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws Exception
     */
    public function testFetchTokensWithoutRefreshToken(): void
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
                            'refresh_token' => 'mockedRefreshToken',
                        ],
                        flags: JSON_THROW_ON_ERROR,
                    ),
                ),
            );

        $clientCredentials = new Password('admin', 'admin');
        $tokens = $clientCredentials->fetchTokens($httpClient, '');


        static::assertSame(
            [
                'access_token' => 'mockedAccessToken',
                'refresh_token' => 'mockedRefreshToken',
            ],
            $tokens,
        );
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws Exception
     */
    public function testFetchTokensWithValidRefreshToken(): void
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
                            'refresh_token' => 'mockedRefreshToken',
                        ],
                        flags: JSON_THROW_ON_ERROR,
                    ),
                ),
            );


        $clientCredentials = new Password('admin', 'admin');
        $tokens = $clientCredentials->fetchTokens($httpClient, '', 'validRefreshToken');

        static::assertSame(
            [
                'access_token' => 'mockedAccessToken',
                'refresh_token' => 'mockedRefreshToken',
            ],
            $tokens,
        );
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws Exception
     */
    public function testFetchTokensWithInvalidRefreshToken(): void
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->expects(static::exactly(2))
            ->method('request')
            ->willReturnOnConsecutiveCalls(
                $this->throwException($this->createMock(ClientException::class)),
                new Response(
                    status: 200,
                    body: json_encode(
                        value: [
                            'access_token' => 'mockedAccessToken',
                            'refresh_token' => 'mockedRefreshToken',
                        ],
                        flags: JSON_THROW_ON_ERROR,
                    ),
                ),
            );


        $clientCredentials = new Password('admin', 'admin');
        $tokens = $clientCredentials->fetchTokens($httpClient, '', 'validRefreshToken');

        static::assertSame(
            [
                'access_token' => 'mockedAccessToken',
                'refresh_token' => 'mockedRefreshToken',
            ],
            $tokens,
        );
    }


    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws Exception
     */
    public function testResponseWithoutRefreshToken(): void
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

        $clientCredentials = new Password('admin', 'admin');
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
