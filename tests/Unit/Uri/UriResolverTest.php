<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Uri;

use Fschmtt\Keycloak\Exception\FilesystemException;
use Fschmtt\Keycloak\Uri\UriResolver;
use PHPUnit\Framework\TestCase;

class UriResolverTest extends TestCase
{
    public function testResolveJson(): void
    {
        // Arrange
        $fixture = 'tests/Fixtures/test-realm.json';
        $expected = file_get_contents($fixture);

        // Act
        $json = (new UriResolver())->resolve($fixture);

        // Assert
        $this->assertSame($expected, $json);
    }

    public function testThrowsExceptionIfFileNotFound(): void
    {
        // Assert
        $this->expectException(FilesystemException::class);

        // Act
        (new UriResolver())->resolve('tests/Fixtures/non-existing-file.json');
    }

    public function testResolveContentOfDir(): void
    {
        // Assert
        $this->markTestIncomplete('Not implemented yet');
    }

    public function testResolveZip(): void
    {
        // Assert
        $this->markTestIncomplete('Not implemented yet');
    }
}
