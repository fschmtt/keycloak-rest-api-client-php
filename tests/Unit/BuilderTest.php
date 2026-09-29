<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit;

use Fschmtt\Keycloak\Builder;
use Fschmtt\Keycloak\Exception\BuilderException;
use Fschmtt\Keycloak\OAuth\GrantType;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Builder::class)]
class BuilderTest extends TestCase
{
    public function testThrowsExceptionIfBaseUrlIsNotSet(): void
    {
        $builder = new Builder();

        $this->expectException(BuilderException::class);
        $this->expectExceptionMessage('Base URL is not set');

        $builder->build();
    }

    public function testThrowsExceptionIfGrantTypeIsNotSet(): void
    {
        $builder = (new Builder())
            ->withBaseUrl('http://keycloak:8080');

        $this->expectException(BuilderException::class);
        $this->expectExceptionMessage('Grant type is not set');

        $builder->build();
    }

    #[DataProvider('invalidVersionProvider')]
    public function testThrowsExceptionIfVersionDoesNotFollowPattern(string $version): void
    {
        $builder = new Builder();

        $this->expectException(BuilderException::class);
        $this->expectExceptionMessage(sprintf('Version must follow the pattern x.y.z (e.g. 26.7.2), got "%s"', $version));

        $builder->withVersion($version);
    }

    public function testWithVersionIsFluent(): void
    {
        $builder = new Builder();

        static::assertSame($builder, $builder->withVersion('26.7.2'));
    }

    public function testPinnedVersionIsUsedWithoutAnyHttpRequest(): void
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->expects(static::never())->method('request');

        $keycloak = (new Builder())
            ->withBaseUrl('http://keycloak:8080')
            ->withGrantType(GrantType::clientCredentials('my-client', 'my-secret', 'my-realm'))
            ->withHttpClient($httpClient)
            ->withVersion('26.7.2')
            ->build();

        static::assertSame('26.7.2', $keycloak->getVersion());
    }

    public static function invalidVersionProvider(): \Generator
    {
        yield 'empty string' => [''];
        yield 'whitespace only' => ['   '];
        yield 'major only' => ['26'];
        yield 'major and minor only' => ['26.7'];
        yield 'too many segments' => ['26.7.2.1'];
        yield 'suffix' => ['26.7.2-SNAPSHOT'];
        yield 'leading v' => ['v26.7.2'];
        yield 'surrounding whitespace' => [' 26.7.2 '];
        yield 'trailing newline' => ["26.7.2\n"];
        yield 'non-numeric segment' => ['26.x.2'];
    }
}
